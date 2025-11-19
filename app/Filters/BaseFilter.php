<?php
/**
 * User: Gamma-iron
 * Date: 19.03.2019
 */

namespace App\Filters;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class BaseFilter
{

    protected $inputs;

    protected $filters = [];

    public function __construct(Collection $inputs)
    {
        $this->inputs = $inputs;
    }

    public function filter(Builder $builder): Builder
    {
        foreach($this->getFilters() as $filter => $value)
        {
            $this->resolveFilter($builder, $filter, $value);
        }

        return $builder;
    }

    protected function getFilters(): iterable
    {
        return $this->inputs->only($this->filters);
    }

    protected function resolveFilter(Builder $builder, $filter, $value): Builder
    {
        $method = 'where'.Str::ucfirst(Str::camel($filter));

        if(method_exists($this,  $method))
            return $this->$method($builder, $value);

        return $builder;
    }

}
