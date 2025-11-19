<?php
/**
 * User: Gamma-iron
 * Date: 26.05.2019
 */

namespace App\Http\ViewComposers;

use App\Entity\Organization\Bank;
use App\Entity\Product\CreditCard;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SidebarCreditCardComposer
{
    public function compose(View $view)
    {
        $topCreditCardIds = CreditCard::select(DB::raw('MAX(credit_cards.rating) AS max_rating, banks.id as bank_id, ANY_VALUE(credit_cards.id) as id'))->leftJoin('banks', function ($join) {
            $join->on('credit_cards.organization_id', '=', 'banks.id')->where('credit_cards.organization_type', '=', Bank::class);
        })->groupBy('bank_id')->orderByDesc('max_rating')->get()->pluck('id');

        $topCreditCards = CreditCard::with('organization')->orderByDesc('rating')->find($topCreditCardIds);

        return $view->with(['topCreditCards' => $topCreditCards] );
    }
}