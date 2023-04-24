<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class DBHeroRepository implements HeroRepositoryInterface
{
    public function getAll(): array
    {
        return DB::table('marvel_heroes')
                ->select('id', 'name', 'marvel_id', 'description', 'image_url', 'votes')
                ->orderBy('votes', 'desc')
                ->orderBy('name', 'asc')
                ->get()
                ->toArray();
    }

    public function vote(int $id): void
    {
        DB::table('marvel_heroes')
            ->where('id', $id)
            ->increment('votes');
    }
}
