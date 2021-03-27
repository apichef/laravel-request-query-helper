<?php

declare(strict_types=1);

namespace ApiChef\RequestQueryHelper;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Sorts
{
    private Collection $fields;

    public function __construct(Request $request)
    {
        $paramName = config('request-query-helper.sort.name');
        $paramSeparator = config('request-query-helper.sort.param_separator');
        $params = $request->filled($paramName) ? explode(',', $request->get($paramName)) : [];

        $this->fields = collect($params)->map(function ($field) use ($paramSeparator) {
            $direction = SortField::DIRECTION_ASCENDING;

            if (Str::startsWith($field, '-')) {
                $direction = SortField::DIRECTION_DESCENDING;
                $field = Str::after($field, '-');
            }

            $parts = explode($paramSeparator, $field);
            $field = $parts[0];

            return new SortField($field, $direction, Arr::get($parts, 1));
        });
    }

    public function filled(): bool
    {
        return $this->fields->isNotEmpty();
    }

    public function each(callable $callback): void
    {
        $this->fields->each($callback);
    }
}
