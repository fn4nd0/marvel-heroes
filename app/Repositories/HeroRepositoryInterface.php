<?php

namespace App\Repositories;

interface HeroRepositoryInterface
{
    public function getAll(): array;
    public function vote(int $id): void;
}
