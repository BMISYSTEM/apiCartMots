<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Resources\MerchantOrder\Item;
use MercadoPago\Resources\Preference;

class PasarelaController extends Controller
{
    public function preferences()
    {
        MercadoPagoConfig::setAccessToken("TEST-a194d62e-4b7a-444a-94cd-ce3b2be7e791");
        $preference = new Preference();
        $item = new Item();
        $item->title = 'Plan Normal';
        $item->quantity = 1;
        $item->unit_price = '250000';
        $preference->items = array($item);
        $preference->back_urls = array(
            "success" => "http://localhost:8080/feedback",
            "failure" => "http://localhost:8080/feedback", 
            "pending" => "http://localhost:8080/feedback"
        );
        $preference->auto_return = "approved"; 
        return response()->json(['id' => $preference]);
    }
}
