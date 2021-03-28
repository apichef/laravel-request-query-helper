<?php

namespace ApiChef\RequestQueryHelper;

trait InteractWithQueryString
{
    protected function prepareSortsForValidation()
    {
        $this->merge([
            'sort' => $this->sorts()->getFields()->mapWithKeys(function (SortField $field) {
                return [$field->getField() => $field->getParams()];
            })->all(),
        ]);
    }
}
