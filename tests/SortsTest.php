<?php

declare(strict_types=1);

namespace ApiChef\RequestQueryHelper;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SortsTest extends TestCase
{
    /** @dataProvider provide_SortQueries */
    public function test_sort($query)
    {
        $request = Request::create($query);

        /** @var Sorts $sorts */
        $sorts = $request->sorts();

        $this->assertInstanceOf(Sorts::class, $sorts);
        $this->assertCount(2, $sorts->getFields());
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

    public function provide_SortQueries(): array
    {
        return [
            ['query' => '/url?sort=-created_at,title'],
            ['query' => '/url?sort[-created_at]&sort[title]'],
        ];
    }

    /** @dataProvider provide_AdvancedSortQueries */
    public function test_can_pass_additional_parameters($query)
    {
        $request = Request::create($query);

        /** @var Sorts $sorts */
        $sorts = $request->sorts();

        /** @var SortField $sortField */
        $sortField = $sorts->getFields()->first();

        $this->assertInstanceOf(Sorts::class, $sorts);

        $this->assertEquals('likes', $sortField->getField());
        $this->assertEquals('desc', $sortField->getDirection());
        $this->assertEquals(['between' => ['2020-02-02', '2021-01-21']], $sortField->getParams());
    }

    public function provide_AdvancedSortQueries(): array
    {
        return [
            ['query' => '/url?sort=-likes:between(2020-02-02|2021-01-21)'],
            ['query' => '/url?sort[-likes][between]=2020-02-02|2021-01-21'],
        ];
    }

    public function test_getFields()
    {
        $request = Request::create('/url');
        $this->assertInstanceOf(Collection::class, $request->sorts()->getFields());
    }
}
