<?php
/**
 * User: Gamma-iron
 * Date: 19.03.2019
 */

namespace App\Filters\Mfo;


use App\Filters\BaseFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

class MfoFilter extends BaseFilter
{
    protected $filters = [
        'min_amount',
        'max_amount',
        'min_term',
        'max_term',
        'min_age',
        'max_age',
        'free_credit_bid',
    ];


    protected function whereMinAmount(Builder $builder, $value): Builder
    {
        if(is_null($value))
            return $builder;

        return $builder->where('min_amount', '>=', $value);
    }

    protected function whereMaxAmount(Builder $builder, $value): Builder
    {
        if(is_null($value))
            return $builder;

        return $builder->where('max_amount', '<=', $value);
    }


    protected function where(Builder $builder, $value): Builder
    {
        if(is_null($value))
            return $builder;

        return $builder->where('min_term', '>=', $value);
    }

    protected function whereMaxTerm(Builder $builder, $value): Builder
    {
        if(is_null($value))
            return $builder;

        return $builder->where('max_term', '<=', $value);
    }

    protected function whereMinAge(Builder $builder, $value): Builder
    {
        if(is_null($value))
            return $builder;

        return $builder->where('min_age', '>=', $value);
    }

    protected function whereMaxAge(Builder $builder, $value): Builder
    {
        if(is_null($value))
            return $builder;

        return $builder->where('max_term', '<=', $value);
    }

    protected function whereFreeCreditBid(Builder $builder, $value): Builder
    {
        if(is_null($value))
            return $builder;

        return $builder->where('free_credit_bid', '<=', $value);
    }

}
