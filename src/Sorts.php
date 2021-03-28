<?php

declare(strict_types=1);

namespace ApiChef\RequestQueryHelper;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Sorts
{
    private Collection $fields;

    public function __construct(string $sorts = null)
    {
        $this->fields = Collection::make();
        $sorts = (new QueryParamBag($sorts))->getParams();
        $fields = array_keys($sorts);

        collect($fields)->each(function (string $field) use ($sorts) {
            $params = $sorts[$field];
            $direction = SortField::DIRECTION_ASCENDING;

            if (Str::startsWith($field, '-')) {
                $direction = SortField::DIRECTION_DESCENDING;
                $field = Str::after($field, '-');
            }

            $this->fields->push(new SortField($field, $direction, $params));
        });
    }

    public function getFields(): Collection
    {
        return $this->fields;
    }
}
