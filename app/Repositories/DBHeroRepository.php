<?php

namespace App\Repositories;

use App\Models\MarvelHero;
use Illuminate\Support\Facades\DB;

class DBHeroRepository implements HeroRepositoryInterface
{
    public function getAll(): array
    {
        return MarvelHero::select('id', 'name', 'marvel_id', 'description', 'image_url', 'votes')
            ->orderBy('votes', 'desc')
            ->orderBy('name', 'asc')
            ->get()
            ->toArray();
    }

    public function vote(int $id): void
    {
        $hero = MarvelHero::findOrFail($id);
        $hero->increment('votes');
    }
}
