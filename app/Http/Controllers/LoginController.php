<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    public function login(Request $Request)
    {
        
        return response()->json($Request->all());
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://212.225.255.130:8010/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPGET, 1);

        $data = curl_exec($ch); // execute curl request
        curl_close($ch);

        $xml = simplexml_load_string($data);
        print_r($xml);
    }
    
}
