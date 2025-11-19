<?php
/**
 * User: Gamma-iron
 * Date: 04.04.2019
 */

namespace App\Filters\Mfo;


use App\Filters\BaseSorteble;


class MfoSorteble extends BaseSorteble
{


    protected function getDefaultSortByField(): string
    {
        return 'free_credit_bid';
    }

    protected function getDefaultSortField(): string
    {
        return self::SORT_DESC;
    }

    protected function getSortByFields(): array
    {
        return [
            'free_credit_bid',
        ];
    }
}