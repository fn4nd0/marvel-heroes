<?php

namespace App\Http\Controllers;

use App\Repositories\HeroRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class HeroController extends Controller
{

    // public function list()
    // {
    //     try {

    //         $heroes = DB::table('marvel_heroes')
    //                     ->select('id', 'name', 'marvel_id', 'description', 'image_url', 'votes')
    //                     ->orderBy('votes', 'desc')
    //                     ->orderBy('name', 'asc')
    //                     ->get()->toArray();
    //         return response()->json(['success' => true, 'heroes' => $heroes]);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }

    // public function voteHero($heroId)
    // {
    //     try {
    //             DB::table('marvel_heroes')
    //                 ->where('id', $heroId)
    //                 ->increment('votes');

    //             return response()->json(['success' => true]);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }

    private HeroRepositoryInterface $heroRepository;

    public function __construct(HeroRepositoryInterface $heroRepository)
    {
        $this->heroRepository = $heroRepository;
    }

    public function list(): JsonResponse
    {
        try {
            $heroes = $this->heroRepository->getAll();
            return response()->json(['success' => true, 'heroes' => $heroes]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function voteHero(int $marvelId): JsonResponse
    {
        try {
            $this->heroRepository->vote($marvelId);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
