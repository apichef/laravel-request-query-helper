<?php

namespace LaravelJsonApiQueryParams;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class JsonApiQueryParamsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/query-params.php' => config_path('query-params.php'),
        ], 'config');

        Request::macro('filters', function () {
            return new QueryParamBag($this, config('query-params.filter'));
        });

        Request::macro('includes', function () {
            return new QueryParamBag($this, config('query-params.include'));
        });

        Request::macro('fields', function () {
            return new Fields($this);
        });

        Request::macro('sorts', function () {
            return new Sorts($this);
        });
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/query-params.php',
            'query-params'
        );
    }
}
