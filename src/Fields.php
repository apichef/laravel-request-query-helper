<?php

declare(strict_types=1);

namespace LaravelJsonApiQueryParams;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class Fields
{
    /** @var Collection $fields */
    private $fields;

    public function __construct(Request $request)
    {
        $this->fields = collect($request->get(config('query-params.fields'), []))
            ->mapWithKeys(function ($value, $key) {
                return [$key => explode(',', $value)];
            });
    }

    public function has($resourceName)
    {
        return $this->fields->has($resourceName);
    }

    public function get(string $resourceName): ?array
    {
        return $this->fields->get($resourceName);
    }
}
