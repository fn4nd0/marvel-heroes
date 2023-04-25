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

    /**
     * This method returns a list of heroes.
     *
     * @return JsonResponse Indicating success or failure.
     */
    public function list(): JsonResponse
    {
        try {
            $heroes = $this->heroRepository->getAll();
            return response()->json(['success' => true, 'heroes' => $heroes]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Increase the vote for the specified Marvel hero.
     *
     * @param  int  $marvelId The ID of the hero to vote for.
     *
     * @return JsonResponse Indicating success or failure.
     *
     * @throws \Exception If there was an error casting the vote.
     */
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
