<?php

namespace App;

use Domains\Medicines\Services\Contracts\ExcelFileReaderInterface;
use Domains\Medicines\Services\ExcelReader;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ExcelFileReaderInterface::class, function (Application $app, array $params) {
            return new ExcelReader($params['reader']);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
    }
}
