<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class HeroController extends Controller
{

    public function list(Request $request)
    {
        try {

            $heroes = DB::table('marvel_heroes')
                        ->select('id', 'name', 'marvel_id')
                        ->orderBy('votes', 'desc')
                        ->orderBy('name', 'asc')
                        ->get()->toArray();
            return response()->json(['success' => true, 'heroes' => $heroes]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function loadHeroInfo($heroId) {
        try {

            $authorizationParams = MarvelAPIAuthorizationController::generateAuthorizationParams();

            $response = Http::get('https://gateway.marvel.com:443/v1/public/characters', array_merge($authorizationParams, [
                'id' => $heroId
            ]));

            $heroData = json_decode($response->body(), true);

            return response()->json(['success' => true, 'heroData' => $heroData['data']['results'][0]]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
