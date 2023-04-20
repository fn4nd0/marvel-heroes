<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HeroLoaderController extends Controller
{
    public function load()
    {
        try {
            $authorizationParams = MarvelAPIAuthorizationController::generateAuthorizationParams();
            $offset = 0;
            $heroes = [];

            do {
                $response = Http::get('https://gateway.marvel.com/v1/public/characters', array_merge($authorizationParams, [
                    'limit' => 100,
                    'offset' => $offset,
                ]));

                $marvelResponse = $response->json();

                $heroes = array_merge($heroes, $marvelResponse['data']['results']);

                $offset += 100;
            } while ($marvelResponse['data']['total'] > $offset);

            foreach ($heroes as $hero) {
                $filteredHero = [
                    'name' => $hero['name'],
                    'marvel_id' => $hero['id']
                ];
                $filteredHeroes[] = $filteredHero;
            }

            DB::table('marvel_heroes')->insert($filteredHeroes);
        } catch (\Exception $e) {
            Log::error("Error no loading. Error: {$e->getMessage()}");
        }
    }

    private function generateAuthorizationParams()
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
