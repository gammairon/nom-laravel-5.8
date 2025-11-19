<?php
/**
 * User: Gamma-iron
 * Date: 10.04.2019
 */

namespace App\Filters;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

abstract class BaseSorteble
{

    const SORT_ASC = 'ASC';

    const SORT_DESC = 'DESC';

    protected $sortBy;

    protected $sort;

    /**
     * BaseSorteble constructor.
     * @param string $orderKey Example 'name_desc' or 'price_asc'
     */
    public function __construct(?string $orderKey)
    {
        $this->parseOrderKey($orderKey);
    }

    public function sort(Builder $builder): Builder
    {
        return $builder->orderBy($this->sortBy, $this->sort);
    }

    private function parseOrderKey(?string $orderKey): void
    {
        if(strpos($orderKey, '_') === false || is_null($orderKey)){
            $this->sortBy = $this->getDefaultSortByField();
            $this->sort =  $this->getDefaultSortField();
        }
        else{
            $parts = explode('_', $orderKey);

            $sortBy = implode('_', $parts);
            $sort = array_pop($parts);

            $this->sortBy = !empty($sortBy) && in_array($sortBy, $this->getSortByFields()) ? $sortBy : $this->getDefaultSortByField();

            $this->sort = !empty($sort) && Arr::exists($this->getSortMethods(), $sort) ? $sort : $this->getDefaultSortField();
        }

    }

    private function getSortMethods(): array
    {
        return [
            'asc' => self::SORT_ASC,
            'desc' => self::SORT_DESC
        ];
    }

    abstract protected function getDefaultSortByField(): string;

    abstract protected function getDefaultSortField(): string;

    abstract protected function getSortByFields(): array;
}