<?php

namespace App\Http\Controllers;

class MarvelApiAuthorizationController extends Controller
{
    /**
     * This method generates the authorization parameters for the Marvel API.
     *
     * @return array The authorization parameters.
     */
    public static function generateAuthorizationParams(): array
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
