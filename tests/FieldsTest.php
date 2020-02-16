<?php

declare(strict_types=1);

namespace ApiChef\RequestQueryHelper;

use Illuminate\Http\Request;

class FieldsTest extends TestCase
{
    public function test_has()
    {
        $request = Request::create('/url?fields[posts]=id,title&fields[comments]=id,body');

        $this->assertTrue($request->fields()->has('posts'));
        $this->assertFalse($request->fields()->has('crap'));
    }

    public function test_get()
    {
        $request = Request::create('/url?fields[posts]=id,title&fields[comments]=id,body');

        $this->assertEquals(['id', 'title'], $request->fields()->get('posts'));
        $this->assertEmpty($request->fields()->get('tags'));
    }

    public function test_filled()
    {
        $request = Request::create('/url');
        $this->assertFalse($request->fields()->filled());

        $request = Request::create('/url?fields[posts]=id');
        $this->assertTrue($request->fields()->filled());
    }
}
