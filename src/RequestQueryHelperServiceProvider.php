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
            return new QueryParamBag($this->get(config('request-query-helper.filter.name')));
        });

        Request::macro('includes', function () {
            return new QueryParamBag($this->get(config('request-query-helper.include.name')));
        });

        Request::macro('fields', function () {
            return new Fields($this->get(config('request-query-helper.fields.name'), []));
        });

        Request::macro('sorts', function () {
            return new Sorts($this->get(config('request-query-helper.sort.name')));
        });

        Request::macro('paginationParams', function () {
            return new PaginationParams(config('request-query-helper.pagination'), $this);
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
