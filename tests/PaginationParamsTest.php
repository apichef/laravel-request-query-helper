<?php

namespace ApiChef\RequestQueryHelper;

use Illuminate\Http\Request;

class PaginationParamsTest extends TestCase
{
    public function test_filled()
    {
        $request = Request::create('/url');
        $this->assertFalse($request->paginationParams()->filled());

        $request = Request::create('/url?page[number]=1');
        $this->assertTrue($request->paginationParams()->filled());
    }

    public function test_params()
    {
        $request = Request::create('/url?page[number]=2&page[size]=12');

        $this->assertEquals(12, $request->paginationParams()->perPage());
        $this->assertEquals(2, $request->paginationParams()->page());
    }

    public function test_default()
    {
        $request = Request::create('/url');

        $this->assertEquals(null, $request->paginationParams()->perPage());
        $this->assertEquals(10, $request->paginationParams()->perPage(10));
        $this->assertEquals(null, $request->paginationParams()->page());
        $this->assertEquals(1, $request->paginationParams()->page(1));
    }
}
