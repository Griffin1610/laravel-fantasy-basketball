<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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
        // Enable foreign key constraints for SQLite
        if (config('database.default') === 'sqlite') {
            Schema::defaultStringLength(191);
            DB::statement('PRAGMA foreign_keys = ON;');
        }
    }
}
