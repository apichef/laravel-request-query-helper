<?php

declare(strict_types=1);

namespace ApiChef\RequestQueryHelper;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SortsTest extends TestCase
{
    public function test_sort()
    {
        $request = Request::create('/url?sort=-created_at,title');

        /** @var Sorts $sorts */
        $sorts = $request->sorts();

        $this->assertInstanceOf(Sorts::class, $sorts);

        $sorts->getFields()->each(function (SortField $sortField) {
            if ($sortField->getField() == 'created_at') {
                $this->assertEquals('desc', $sortField->getDirection());
            }

            if ($sortField->getField() == 'title') {
                $this->assertEquals('asc', $sortField->getDirection());
            }

            $this->assertEquals([], $sortField->getParams());
        });
    }

    public function test_can_pass_additional_parameters()
    {
        $request = Request::create('/url?sort=-likes:between(2020-02-02|2021-01-21)');

        $sorts = $request->sorts();

        $this->assertInstanceOf(Sorts::class, $sorts);

        $sorts->getFields()->each(function (SortField $sortField) {
            $this->assertEquals('likes', $sortField->getField());
            $this->assertEquals('desc', $sortField->getDirection());
            $this->assertEquals(['between' => ['2020-02-02', '2021-01-21']], $sortField->getParams());
        });
    }

    public function test_getFields()
    {
        $request = Request::create('/url');
        $this->assertInstanceOf(Collection::class, $request->sorts()->getFields());
    }
}
