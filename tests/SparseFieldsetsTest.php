<?php

declare(strict_types=1);

namespace LaravelJsonApiQueryParams;

use Illuminate\Http\Request;

class SparseFieldsetsTest extends TestCase
{
    public function test_can_sparse_fieldsets()
    {
        $request = Request::create('/url?fields[posts]=slug,title');

        $fields = $request->fields();

        $this->assertInstanceOf(Fields::class, $fields);

        $expected = [
            'slug',
            'title',
        ];

        $this->assertTrue($fields->has('posts'));
        $this->assertFalse($fields->has('crap'));

        $this->assertEquals($expected, $fields->get('posts'));
    }
}
