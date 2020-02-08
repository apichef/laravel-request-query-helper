<?php

declare(strict_types=1);

namespace LaravelJsonApiQueryParams;

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
}
