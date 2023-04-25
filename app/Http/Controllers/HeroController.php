<?php

namespace App\Http\Controllers;

use App\Repositories\HeroRepositoryInterface;
use Illuminate\Http\JsonResponse;

class HeroController extends Controller
{
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
