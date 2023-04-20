<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MarvelAPIAuthorizationController extends Controller
{
    public static function generateAuthorizationParams()
    {
        $ts = time();
        $privateKey = env('MARVEL_PRIVATE_KEY');
        $publicKey = env('MARVEL_PUBLIC_KEY');
        $hash = md5($ts . $privateKey . $publicKey);

        return [
            'apikey' => $publicKey,
            'ts' => $ts,
            'hash' => $hash,
        ];
    }
}
