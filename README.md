# laravel-json-api-query-params

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-ci]][link-ci]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

# Easily interact with JSON-API query params.

## Install

Via Composer

``` bash
$ composer require apichef/laravel-request-query-helper
```

You can publish the config file with:

```bash
$ php artisan vendor:publish --provider="ApiChef\RequestQueryHelper\RequestQueryHelperServiceProvider"
```

## Usage

#### Configuration

Default configuration is follows the [{json:api} specification](https://jsonapi.org/format/#fetching).

```php
return [
    /* Configuration for inclusion of related resources */
    'include' => [
        'name' => 'include',
    ],

    /* Configuration for filtering resource collections */
    'filter' => [
        'name' => 'filter',
    ],

    /* Configuration for sorting resource collections */
    'sort' => [
        'name' => 'sort',
    ],

    /* Configuration for sparse field-sets */
    'fields' => [
        'name' => 'fields',
    ],

    /* Configuration for pagination */
    'pagination' => [
        'name' => 'page',
        'number' => 'number',
        'size' => 'size',
    ],
];
```

## Includes and Filters

This package adds `filters` and  `includes` methods to the query object. Both methods returns `QueryParamBag`, which is capable of parsing array-based and string-based request query strings.

Eg:
```
GET '/posts?include=comments:limit(5):sort(created_at|desc),author'
```
or
```
GET '/posts?include[comments][limit]=5&include[comments][sort]=created_at|desc&include[author]'
```

Following examples are based on above request.

```php
use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function show(Request $request)
    {
        $params = $request->includes();
        
        // has
        
        $params->has('comments'); // true
        $params->has('comments.limit'); // true
        $params->has('comments.sort'); // true
        $params->has('comments.foo'); // false
        $params->has('author'); // true
        
        // get
        
        $params->get('comments.limit'); // [5]
        $params->get('comments.sort'); // ['created_at', 'desc']
        
        // isEmpty
        
        $params->isEmpty('comments'); // false
        $params->isEmpty('author'); // true
    }
}

## Sorts

// todo

## Fields

// todo

## Pagination

// todo
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email milroy@outlook.com instead of using the issue tracker.

## Credits

- [Milroy E. Fraser][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/apichef/laravel-request-query-helper.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-ci]: https://github.com/apichef/laravel-request-query-helper/workflows/CI/badge.svg
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/apichef/laravel-request-query-helper.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/apichef/laravel-request-query-helper.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/apichef/laravel-request-query-helper.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/apichef/laravel-request-query-helper
[link-ci]: https://github.com/apichef/laravel-request-query-helper/actions
[link-scrutinizer]: https://scrutinizer-ci.com/g/apichef/laravel-request-query-helper/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/apichef/laravel-request-query-helper
[link-downloads]: https://packagist.org/packages/apichef/laravel-request-query-helper
[link-author]: https://github.com/milroyfraser
[link-contributors]: ../../contributors
