<?php

namespace App\Repositories;

use App\Models\MarvelHero;

/**
 * Repository for managing Marvel heroes in the database.
 */
class DBHeroRepository implements HeroRepositoryInterface
{
    /**
     * Gets all heroes from the database.
     *
     * @return array An array of hero data ordered by votes and then by name.
     */
    public function getAll(): array
    {
        return MarvelHero::select('id', 'name', 'marvel_id', 'description', 'image_url', 'votes')
            ->orderBy('votes', 'desc')
            ->orderBy('name', 'asc')
            ->get()
            ->toArray();
    }

    /**
     * Increment the vote count for the hero with the specified ID.
     *
     * @param int $id The ID of the hero to cast a vote for.
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If no hero with the specified ID exists.
     */
    public function vote(int $id): void
    {
        $hero = MarvelHero::findOrFail($id);
        $hero->increment('votes');
    }
}
