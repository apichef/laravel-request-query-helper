<?php

declare(strict_types=1);

namespace ApiChef\RequestQueryHelper;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class Fields
{
    /** @var Collection */
    private $fields;

    public function __construct(Request $request)
    {
        $this->fields = collect($request->get(config('request-query-helper.fields'), []))
            ->mapWithKeys(function ($value, $key) {
                return [$key => explode(',', $value)];
            });
    }

    public function has($resourceName)
    {
        return $this->fields->has($resourceName);
    }

    public function get(string $resourceName): array
    {
        return $this->fields->get($resourceName, []);
    }

    public function filled(): bool
    {
        return $this->fields->isNotEmpty();
    }
}
