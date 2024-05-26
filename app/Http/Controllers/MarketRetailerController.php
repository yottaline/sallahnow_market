<?php

namespace App\Http\Controllers;

use App\Models\Market_retailer;
use App\Models\Market_store;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class MarketRetailerController extends Controller
{
    //

    public function register(Request $request)
    {
        $request->validate([
            'full_name'         => 'required',
            'retaile_phone'     => 'required',
            'retailer_password' => 'required',
            'retailer_email'    => 'required',
            'store_name'        => 'required',
            'official_name'     => 'required',
            // 'store_mobile'      => 'required',
            'store_phone'       => 'required',
            'tax_store'         => 'required',
            'cr_store'          => 'required',
            'country_id'        => 'required',
            'state_id'          => 'required',
            'city_id'           => 'required',
            'area_id'           => 'required',
            'address'           => 'required'
        ]);

        // retailer validate data
        $id = $request->retailer_id;
        $phone = $request->retaile_phone;
        // store validate data
        $store_id = $request->store_id;
        $store_phone = $request->store_phone;
        // $store_mobile = $request->store_mobile;


        if (count(Market_retailer::fetch(0, [['retailer_id', '!=', $id], ['retailer_phone', '=', $phone]])))
        {
            echo json_encode(['status' => false,'message' =>  'The phone number of the retailer is used']);
            return;
        }


        if (count(Market_store::fetch(0, [['store_id', '!=', $store_id], ['store_phone', '=', $store_phone]])))
        {
            echo json_encode(['status' => false,'message' =>  'The phone number of the store is used']);
            return;
        }

        // if ($store_mobile && count(Market_store::fetch(0, [['store_id', '!=', $store_id], ['store_mobile', '=', $store_mobile]])))
        // {
        //     echo json_encode(['status' => false,'message' =>  'The mobile number of the store is used']);
        //     return;
        // }



        $store_param = [
            'store_name'   => $request->store_name,
            'store_code'   => $this->uniqidReal(8),
            'store_official_name' => $request->official_name,
            'store_cr'            => $request->cr_store,
            'store_tax'           => $request->tax_store,
            'store_phone'         => $request->store_phone,
            'store_mobile'        => $request->store_mobile ? $request->store_mobile : '12345',
            'store_country'       => $request->country_id,
            'store_state'         => $request->state_id,
            'store_city'          => $request->city_id,
            'store_area'          => $request->area_id,
            'store_address'       => $request->address,
            'store_cerated'       => Carbon::now()
        ];

        $store = Market_store::submit($store_param, $store_id);
        $retailer_param = [
            'retailer_name'     => $request->full_name,
            'retailer_email'    => $request->retailer_email,
            'retailer_phone'    => $request->retaile_phone,
            'retailer_password' => Hash::make($request->retailer_password),
            'retailer_store'    => $store,
            'retailer_approved_by' => 1,
            'retailer_register'    => Carbon::now()
        ];

        $result = Market_retailer::submit($retailer_param, $id);
        echo json_encode([
            'status' => boolval($result),
            'data' => $id ? Market_retailer::fetch($id) : [],
        ]);

    }

    public function profile()
    {
        $retailer = Market_store::getRetailerStore();
        return view('profile.index', compact('retailer'));
    }

    public function ChangeStatus(Request $request)
    {
        $id    = $request->id;
        $params = ['retailer_approved' => 0];
        $result = Market_retailer::submit($params, $id);
        echo json_encode(['status' => boolval($result), 'data' => $result ? Market_retailer::fetch($id) : []]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
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