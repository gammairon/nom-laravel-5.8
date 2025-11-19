<?php
/**
 * User: Gamma-iron
 * Date: 26.05.2019
 */

namespace App\Http\ViewComposers;


use App\Entity\Organization\Bank;
use App\Entity\Product\CreditCash;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SidebarCreditCashComposer
{

    public function compose(View $view)
    {
        $topCreditCashIds = CreditCash::select(DB::raw('MAX(credit_cash.rating) AS max_rating, banks.id as bank_id, ANY_VALUE(credit_cash.id) as id'))->leftJoin('banks', function ($join) {
            $join->on('credit_cash.organization_id', '=', 'banks.id')->where('credit_cash.organization_type', '=', Bank::class);
        })->groupBy('bank_id')->orderByDesc('max_rating')->get()->pluck('id');

        $topCreditCash = CreditCash::with('organization')->orderByDesc('rating')->find($topCreditCashIds);

        return $view->with(['topCreditCash' => $topCreditCash] );
    }

}