<?php

namespace ApiChef\RequestQueryHelper;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class RequestQueryHelperServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/request-query-helper.php' => config_path('request-query-helper.php'),
        ], 'config');

        Request::macro('filters', function () {
            return new QueryParamBag($this, config('request-query-helper.filter.name'));
        });

        Request::macro('includes', function () {
            return new QueryParamBag($this, config('request-query-helper.include.name'));
        });

        Request::macro('fields', function () {
            return new Fields($this);
        });

        Request::macro('sorts', function () {
            return new Sorts($this);
        });

        Request::macro('paginationParams', function () {
            return new PaginationParams($this);
        });
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/request-query-helper.php',
            'query-params'
        );
    }
}
