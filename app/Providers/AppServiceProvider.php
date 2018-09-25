<?php

namespace App\Providers;

use App\{
    Jobs, Contracts, DataSources, Storages
};

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Bind dependencies for CatalogUpdate job
        $this->app->when(Jobs\CatalogUpdate::class)
            ->needs(Contracts\DataSource::class)
            ->give(DataSources\Markethot::class);

        $this->app->when(Jobs\CatalogUpdate::class)
            ->needs(Contracts\DataStorage::class)
            ->give(Storages\Products::class);
    }
}
