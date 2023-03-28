<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class PeopleCompanyFocusFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->whereHas('companies', function (Builder $query) use ($value) {
            return $query->whereHas('focus', function (Builder $subquery) use ($value) {
                if (is_array($value) === true) {
                    $subquery->whereIn('name', $value);
                } else {
                    $subquery->where('name', $value);
                }
            });
        });
    }
}
