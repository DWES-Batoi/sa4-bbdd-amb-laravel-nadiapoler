<?php

namespace App\Providers;

use App\Repositories\BaseRepository;
use App\Repositories\EquipRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\JugadoraRepository;
use App\Repositories\PartitRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BaseRepository::class, EquipRepository::class);


        // Para que funcione el test EstadiCrudFeatureTest dejar esto 
        // sin comentar y el de EquipRepository comentado
        // $this->app->bind(BaseRepository::class, EstadiRepository::class);


        // Para que se inyecte correctamente en los servicios
        $this->app->bind('JugadoraRepo', JugadoraRepository::class);
        $this->app->bind('PartitRepo', PartitRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
