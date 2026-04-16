<?php

namespace App\Providers;

use App\Models\Peminjaman;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
        View::composer('layouts.mahasiswa', function ($view) {

        if (!Auth::check()) {
            return;
        }

        $lateBorrow = Peminjaman::where('user_id', Auth::id())
        ->where('status', 'dipinjam')
        ->whereDate('tanggal_pinjam', '<=', now()->subDays(7))
        ->exists();

        $view->with('lateBorrow', $lateBorrow);
    });
    }
}
