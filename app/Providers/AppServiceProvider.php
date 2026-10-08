<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Mensagem;
use Illuminate\Support\Facades\View;

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
        View::composer(['painelProfissional.*', 'user.*'], function ($view) {
            $naoLidas = 0;

            if (session()->has('id')) {
                $naoLidas = Mensagem::where('codDestinatario', session('id'))
                    ->where('lidaMensagem', false)
                    ->count();
            }

            $view->with('naoLidas', $naoLidas);
        });
    }
}
