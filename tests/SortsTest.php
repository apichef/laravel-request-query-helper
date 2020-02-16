<?php

declare(strict_types=1);

namespace ApiChef\RequestQueryHelper;

use Illuminate\Http\Request;

class SortsTest extends TestCase
{
    public function test_sort()
    {
        $request = Request::create('/url?sort=-created_at,title');

        $sorts = $request->sorts();

        $this->assertInstanceOf(Sorts::class, $sorts);

        $sorts->each(function (SortField $sortField) {
            if ($sortField->getField() == 'created_at') {
                $this->assertEquals('desc', $sortField->getDirection());
            }

            if ($sortField->getField() == 'title') {
                $this->assertEquals('asc', $sortField->getDirection());
            }
        });
    }

    public function test_filled()
    {
        $request = Request::create('/url');
        $this->assertFalse($request->sorts()->filled());

        $request = Request::create('/url?sort=-created_at');
        $this->assertTrue($request->sorts()->filled());
    }
}
