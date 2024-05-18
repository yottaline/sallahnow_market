<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    //

    public function getLocation()
    {
        $params[] = ['location_type', '1'];
        $countries = Location::fetch(0, $params);

        echo json_encode($countries);
    }

    function load(Request $req)
    {
        $locations = Location::where('location_type', $req->type)
            ->where('location_parent', $req->parent)
            ->orderBy('location_id', 'ASC')->get();
        echo json_encode($locations);
    }
}