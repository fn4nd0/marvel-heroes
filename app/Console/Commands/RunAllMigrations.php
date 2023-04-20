<?php

namespace App\Console\Commands;

use App\Http\Controllers\HeroLoaderController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class RunAllMigrations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:run-all-migrations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create database, tables and load heroes from Marvel API.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Artisan::call('migrate', ['--force' => true]);

        $this->info('Loading initial data from Marvel heroes...');

        $heroLoader = new HeroLoaderController();
        $heroLoader->load();
    }
}
