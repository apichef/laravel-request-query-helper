<?php

declare(strict_types=1);

namespace ApiChef\RequestQueryHelper;

use Illuminate\Support\Collection;

class Fields
{
    private Collection $fields;

    public function __construct(array $fields)
    {
        $this->fields = collect($fields)
            ->mapWithKeys(function ($value, $key) {
                return [$key => explode(',', $value)];
            });
    }

    public function has($resourceName): bool
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
