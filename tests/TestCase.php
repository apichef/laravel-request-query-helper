<?php

namespace ApiChef\RequestQueryHelper;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            RequestQueryHelperServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
        $app['config']->set('request-query-helper', [
            'include' => [
                'name' => 'include',
            ],
            'filter' => [
                'name' => 'filter',
            ],
            'sort' => [
                'name' => 'sort',
            ],
            'fields' => [
                'name' => 'fields',
            ],
            'pagination' => [
                'name' => 'page',
                'number' => 'number',
                'size' => 'size',
            ],
        ]);
    }
}
