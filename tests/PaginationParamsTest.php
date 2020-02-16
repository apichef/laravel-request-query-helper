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
}
