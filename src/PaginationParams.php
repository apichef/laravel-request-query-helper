<?php

namespace ApiChef\RequestQueryHelper;

use Illuminate\Http\Request;

class PaginationParams
{
    private $config;

    /** @var Request $request */
    private $request;

    public function __construct(Request $request)
    {
        $this->config = config('request-query-helper.pagination');
        $this->request = $request;
    }

    public function perPage(): ?int
    {
        return (int) $this->request->input("{$this->config['name']}.{$this->config['size']}");
    }

    public function pageName(): string
    {
        return $this->config['name'];
    }

    public function page(): ?int
    {
        return (int) $this->request->input("{$this->config['name']}.{$this->config['number']}");
    }

    public function filled(): bool
    {
        return $this->request->filled($this->config['name']);
    }
}
