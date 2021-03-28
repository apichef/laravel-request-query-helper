<?php declare(strict_types=1);

namespace ApiChef\RequestQueryHelper;

use ApiChef\RequestQueryHelper\Dummy\TestRequest;
use Illuminate\Support\Facades\Route;

class InteractWithQueryStringTest extends TestCase
{
    /** @dataProvider provide_AdvancedSortQueries */
    public function test_can_prepare_sorts_for_validation($query)
    {
        Route::get('test', function (TestRequest $request) {
            return 'ok';
        })->name('test');

        $this->getJson(route('test').$query)
            ->assertJsonFragment([
                'errors' => [
                    'sort.likes.between.1' => [
                        'The sort.likes.between.1 does not match the format Y-m-d.'
                    ]
                ]
            ]);
    }

    public function provide_AdvancedSortQueries(): array
    {
        return [
            ['query' => '?sort=-likes:between(2020-02-02|2021-01-xx)'],
            ['query' => '?sort=likes:between(2020-02-02|2021-01-xx)'],
            ['query' => '?sort[-likes][between]=2020-02-02|2021-01-xx'],
            ['query' => '?sort[likes][between]=2020-02-02|2021-01-xx'],
        ];
    }
}
