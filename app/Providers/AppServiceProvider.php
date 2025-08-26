<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
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
        // Set bahasa ke Indonesia
        Carbon::setLocale('id');


        if (request()->is('/')) {
            if (Schema::hasTable('pengunjung')) {
                $ip = request()->ip();

                $exists = DB::table('pengunjung')->where('ip_address', $ip)->exists();

                if (!$exists) {
                    DB::table('pengunjung')->insert([
                        'ip_address' => $ip,
                        'first_visited_at' => now(),
                    ]);
                }
            }
        }
    }
}
