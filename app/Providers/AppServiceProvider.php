<?php

namespace App\Providers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('database.default') === 'sqlite') {
            $dbPath = config('database.connections.sqlite.database');

            if ($dbPath && $dbPath !== ':memory:') {
                if (!file_exists($dbPath)) {
                    @mkdir(dirname($dbPath), 0777, true);
                    touch($dbPath);
                }

                try {
                    if (!Schema::hasTable('users')) {
                        Artisan::call('migrate', [
                            '--seed' => true,
                            '--force' => true,
                        ]);
                    }
                } catch (\Throwable $e) {
                    // Prevents boot loop during artisan CLI commands
                }
            }
        }
    }
}
