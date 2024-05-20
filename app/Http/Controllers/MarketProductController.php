<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Market_store;
use App\Models\Market_category;
use App\Models\Market_subcategory;
use App\Models\Market_product;
use App\Models\Market_product_photo;
use App\Models\Market_retailer;
use Carbon\Carbon;

class MarketProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Market_category::fetch();
        $subcategories = Market_subcategory::fetch();
        return view('content.products.index', compact('categories', 'subcategories'));
    }

    public function load(Request $request)
    {
        $params   = $request->q ? ['q', $request->q] : [];
        $limit   = $request->limit;
        $lastId  = $request->last_id;

        if($request->price) $params[]       = ['product_price',  $request->price];
        if($request->category) $params[]    = ['product_category', $request->category];
        if($request->subcategory) $params[] = ['product_subcategory', $request->subcategory];

        echo json_encode(Market_product::fetch(0, $params, $limit, $lastId));
    }

    public function getSubCategory($id)
    {
        $param[] = ['category_id', '=', $id];
        echo json_encode(Market_subcategory::fetch(0, $param));
    }

    public function submit(Request $request)
    {
        $request->validate([
            'name'        => 'required',
            'categoy'     => 'required',
            'subcategoy'  => 'required',
            'price'       => 'required',
            'disc'        => 'required',
            'image.*'       => 'required|image|mimes:jpeg,png,jpg,gif,webp',
            'description' => 'required'
        ]);

        $id   = $request->product_id;
        $store = Market_store::getRetailerStore();

        $param = [
            'product_code'  => $this->uniqidReal(8),
            'product_name'  => $request->name,
            'product_store' => $store->store_id,
            'product_category' => $request->categoy,
            'product_subcategory' => $request->subcategoy,
            'product_desc'        => $request->description,
            'product_price'       => $request->price,
            'product_disc'        => $request->disc,
            'product_photo'       =>  1,
            'product_views'       => 0,
            'product_cerated'     => Carbon::now()
        ];

        $product = Market_product::submit($param, $id);

        if(boolval($product))
        {
            $images = $request->file('image');
            if ($images && count($images) > 0) {
                foreach ($images as $image) {
                    $fileName = $this->uniqidReal(8) . '.' . $image->getClientOriginalExtension();
                    $image->move('images/product/', $fileName);

                    $params = [
                        'photo_file'    => $fileName,
                        'photo_product' => $product,
                        'photo_cerated' => Carbon::now(),
                    ];

                    $result = Market_product_photo::submit($params, null);
                }
            }
        }

        echo json_encode([
            'status' => boolval($result),
            'data'   => $result ? Market_product::fetch($product) : []
        ]);


    }

    public function changeStatus(Request $request)
    {
        $status = 0;
        if($request->status) $status = 1;
        $param = ['product_show' => $status];
        $id = $request->product_id;
        $result = Market_product::submit($param, $id);
        echo json_encode([
            'status' => boolval($result),
            'data'=> $result ? Market_product::fetch($request->product_id) : []
        ]);

    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $param = ['product_delete' => 1];
        $result  = Market_product::submit($param, $id);
        echo json_encode(['status' => boolval($result)]);
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