<?php

declare(strict_types=1);

namespace ApiChef\RequestQueryHelper;

class SortField
{
    const DIRECTION_ASCENDING = 'asc';
    const DIRECTION_DESCENDING = 'desc';

    private string $field;
    private string $direction;
    private array $params;

    public function __construct(string $field, string $direction, array $params = [])
    {
        $this->field = $field;
        $this->direction = $direction;
        $this->params = $params;
    }

    public function getField(): string
    {
        return $this->field;
    }

    public function getDirection(): string
    {
        return $this->direction;
    }

    public function getParams(): array
    {
        return $this->params;
    }
}
