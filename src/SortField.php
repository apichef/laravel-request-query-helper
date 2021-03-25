<?php

declare(strict_types=1);

namespace ApiChef\RequestQueryHelper;

class SortField
{
    const DIRECTION_ASCENDING = 'asc';
    const DIRECTION_DESCENDING = 'desc';

    /** @var string */
    private $field;

    /** @var string */
    private $direction;

    /** @var string|null */
    private $params;

    public function __construct(string $field, string $direction, string $params = null)
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

    public function getParams(): ?string
    {
        return $this->params;
    }
}
