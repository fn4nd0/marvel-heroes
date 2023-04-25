<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;

class HeroLoaderController extends Controller
{
    /**
     * This method loads the heroes from the Marvel API and stores them in the database.
     *
     * @return JsonResponse Indicating success or failure.
     */
    public function load(): JsonResponse
    {
        try {
            $authorizationParams = MarvelApiAuthorizationController::generateAuthorizationParams();
            $offset = 0;
            $heroes = [];

            if (empty($authorizationParams['apikey'])) {
                return response()->json(['success' => false, 'error' => 'Marvel API Key not found. Check the keys in your .env file']);
            }

            do {
                $response = Http::get('https://gateway.marvel.com/v1/public/characters', array_merge($authorizationParams, [
                    'limit' => 100,
                    'offset' => $offset,
                ]));

                $marvelResponse = $response->json();

                $heroes = array_merge($heroes, $marvelResponse['data']['results']);

                $offset += 100;
            } while ($marvelResponse['data']['total'] > $offset);

            $filteredHeroes = [];
            foreach ($heroes as $hero) {

                $url = $hero['thumbnail']['path'] . '.' . $hero['thumbnail']['extension'];

                $filteredHero = [
                    'name' => $hero['name'],
                    'marvel_id' => $hero['id'],
                    'description' => $hero['description'],
                    'image_url' => $url
                ];
                $filteredHeroes[] = $filteredHero;
            }

            DB::table('marvel_heroes')->insert($filteredHeroes);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error("[HeroLoaderController][load][Error: " . $e->getMessage() . "]");
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

}
