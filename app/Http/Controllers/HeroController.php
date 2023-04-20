<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HeroController extends Controller
{
    public function list(Request $request)
    {
        try {
            $authorizationParams = $this->generateAuthorizationParams();

            $response = Http::get('https://gateway.marvel.com/v1/public/characters', $authorizationParams);

            $marvelResponse = $response->json();
            dd($marvelResponse['data']['results']);
            $heroes = $marvelResponse['data']['results'];


            return response()->json($heroes);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    function generateAuthorizationParams()
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
