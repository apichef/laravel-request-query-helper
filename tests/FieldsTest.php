<?php

declare(strict_types=1);

namespace LaravelJsonApiQueryParams;

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
        $this->assertNull($request->fields()->get('tags'));
    }
}
