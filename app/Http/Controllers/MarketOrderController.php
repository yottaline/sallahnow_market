<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Market_order;
use App\Models\Market_order_item;
use App\Models\Market_product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MarketOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $customers = Customer::fetch();
        return view('content.orders.index', compact('customers'));
    }

    public function load(Request $request)
    {
        $params = $request->q ? ['q' => $request->q] : [];
        $limit  = $request->limit;
        $lastId = $request->last_id;

        if ($request->status) $params[] = ['order_status', $request->status];
        if ($request->date) $params[] = ['order_create', 'like', "%{$request->date}%"];

        echo json_encode(Market_order::fetch(0, $params, $limit, $lastId));
    }

    public function submit(Request $request)
    {
        $ids = explode(',', $request->id);
        $qty = explode(',', $request->qty);
        $disc = explode(',', $request->disc);

        $ordSubtotal = $orderTotalDisc = $ordTotal = 0;
        $orderItemParam = [];
        $products     = Market_product::fetchByIds($ids);
        foreach ($products as $p) {
            $indx = array_search($p->product_id, $ids);
            if ($indx !== false) {
                $subtotal = $qty[$indx] * $p->product_price;
                $total    = $subtotal * $disc[$indx] / 100;
                $orderItemParam[] = [
                    'orderItem_product'      => $p->product_id,
                    'orderItem_productPrice' => $p->product_price,
                    'orderItem_subtotal'     => $subtotal,
                    'orderItem_disc'         => $p->product_disc,
                    'orderItem_total'        => $total,
                    'orderItem_qty'               => $qty[$indx]
                ];
                $ordSubtotal    += $subtotal;
                $orderTotalDisc += $total - $subtotal;
                $ordTotal       += $total;
            }
        }
        $orderParam = [
            'order_code'            => $this->uniqidReal(10),
            'order_customer'        => $request->customer_id,
            'order_note'            => $request->note,
            'order_subtotal'        => $ordSubtotal,
            'order_disc'            => intval($request->orderdisc),
            'order_totaldisc'       => $orderTotalDisc,
            'order_total'           => $ordTotal,
            'order_status'          => 1,
            'order_create'          => Carbon::now()
        ];

        $result = Market_order::submit(0, $orderParam, $orderItemParam);

        if($result['status']) $result['data'] = Market_order::fetch($result['id']);

        echo json_encode($result);

    }

    public function viewOrder($orderId)
    {
        $order = Market_order::fetch($orderId);
        $param[] = ['market_orders.order_id', $orderId];
        $items  = Market_order_item::fetch(0,$param);
        echo json_encode(['order' => $order, 'items' => $items]);

    }

    public function updateStatus(Request $request)
    {
        $col = in_array($request->status, [2, 3])
            ? 'order_exec'
            : ($request->status == 4 ? 'order_approved' : 'order_deliverd');
        $param = [
            'order_status' => $request->status,
            $col => Carbon::now(),
        ];
        $result =  Market_order::submit($request->id, $param);
        echo json_encode([
            'status'  => boolval($result),
        ]);
    }

    private function uniqidReal($lenght = 12)
    {
        if (function_exists("random_bytes")) {
            $bytes = random_bytes(ceil($lenght / 2));
        } elseif (function_exists("openssl_random_pseudo_bytes")) {
            $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
        } else {
            throw new \Exception("no cryptographically secure random function available");
        }
        return substr(bin2hex($bytes), 0, $lenght);
    }
}