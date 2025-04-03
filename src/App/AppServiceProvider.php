<?php

namespace App;

use Domains\Medicines\Services\Contracts\FileImporterInterface;
use Domains\Medicines\Services\Contracts\FileReaderInterface;
use Domains\Medicines\Services\ExcelFileImporter;
use Domains\Medicines\Services\ExcelFileReader;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app->bind(FileReaderInterface::class, function (Application $app) {
            return $app->make(ExcelFileReader::class);
        });

        $this->app->bind(FileImporterInterface::class, function (Application $app) {
            return $app->make(ExcelFileImporter::class);
        });

//        $this->app->bind(ExcelFileReaderInterface::class, function (Application $app, array $params) {
//            return new ExcelReader($params['reader']);
//        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
    }
}
