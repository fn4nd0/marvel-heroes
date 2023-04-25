<?php

namespace App\Console\Commands;

use App\Http\Controllers\HeroLoaderController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

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
        try {
            Artisan::call('migrate', ['--force' => true]);

            $this->info('Loading initial heros data from Marvel API...');
            $heroLoader = new HeroLoaderController();
            $loadResult = $heroLoader->load();
            $decodedResult = $loadResult->getData();

            if (!$decodedResult->success) {
                $this->info($decodedResult->error);
            } else {
                $this->info('Data Loaded!');
            }

        } catch (\Exception $e) {
            Log::error("[RunAllMigrations][handle][Error: " . $e->getMessage() . "]");
            $this->info('Error: ' . $e->getMessage());
        }
    }
}
