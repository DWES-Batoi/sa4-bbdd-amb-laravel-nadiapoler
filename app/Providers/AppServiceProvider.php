<?php

namespace App\Providers;

use App\Repositories\BaseRepository;
use App\Repositories\EquipRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\JugadoraRepository;
use App\Repositories\PartitRepository;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        /* Para que funcione el test "EstadiCrudFeatureTest" hay que dejar esto 
           sin comentar y el de "EquipRepository" comentado 
        */
        // $this->app->bind(BaseRepository::class, EstadiRepository::class);
        $this->app->bind(BaseRepository::class, EquipRepository::class);

        // Para que se inyecte correctamente en los servicios
        $this->app->bind('JugadoraRepo', JugadoraRepository::class);
        $this->app->bind('PartitRepo', PartitRepository::class);
    }

    public function boot(): void
    {
        Route::prefix('api')
            ->middleware('api')
            ->group(base_path('routes/api.php'));
    }
}
