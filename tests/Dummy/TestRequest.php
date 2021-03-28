<?php

declare(strict_types=1);

namespace ApiChef\RequestQueryHelper\Dummy;

use ApiChef\RequestQueryHelper\InteractWithQueryString;
use Illuminate\Foundation\Http\FormRequest;

class TestRequest extends FormRequest
{
    use InteractWithQueryString;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'sort.likes.between.*' => 'date_format:Y-m-d',
        ];
    }

    protected function prepareForValidation()
    {
        $this->prepareSortsForValidation();
    }
}
