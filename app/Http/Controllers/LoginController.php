<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{   //ESTA FUNCION RECIBE LOS DATOS DESDE ANGULAR
    public function login(Request $Request)
    {
        $data1 = null;
        //CREAMOS LAS VARIABLES NECESARIAS Y LAS IGUALAMOS A LAS RECIBIDAS
        $Password = $Request->pass;
        $User = $Request->user;
        $Ip = $Request->ip;

        //ENCRIPTAMOS LOS DATOS DE USUARIO, IP Y /UVCUSROP2
        $strMd5 = $User . $Ip . "/uvcusrop2";
        $iToken = md5($strMd5);


        //HACEMOS LA PETICION GET LA CUAL NOS TRAERA LOS DATOS EN FUNCION DE LA URL QUE LE ENVIEMOS
        $url = "http://212.225.255.130:8010/ws/uvcusrop2/" . $Ip . "/" . $iToken . "/" . $User . "/" . $Password;
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPGET, 1);

        $data = curl_exec($ch); // execute curl request
        curl_close($ch);

        //CONVERTIMOS EL STRING EN UN OBJETO XML        
        $xml =  simplexml_load_string(utf8_encode($data));
        foreach ($xml->Result as $result) {
            $values = $result->attributes();
            $id = (string)trim($values->{'id'});
            $con = (string)trim($values->{'con'});
            $cof = (string)trim($values->{'cof'});
            $des = (string)trim($values->{'des'});
            $doc = (string)trim($values->{'doc'});
            $tp = (string)trim($values->{'tp'});



            $data1 = array('id' => $id, 'con' => $con, 'cof' => $cof, 'des' => $des, 'doc' => $doc, 'tp' => $tp);
        }


        //DEVOLVEMOS LOS DATOS RECIBIDOS

        return response()->json(json_encode($xml), 200);
    }
}
