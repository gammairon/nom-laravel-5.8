<?php

namespace App\Http\Controllers\Front;

use App\Entity\Organization\Bank;
use App\Entity\Product\CreditCard;
use App\Entity\Seo\Seo;
use App\UseCases\JsonLd\Product;
use App\Http\Controllers\Controller;

class CreditCardController extends Controller
{

    public function all()
    {
        $banks = Bank::with(['creditsCard' => function($query){
            return $query->with('media')->orderByDesc('rating');
        }, 'media'])->orderByDesc('rating')->get();
        $this->setSeo(Seo::whereSeoeableType('credit_cards_archive')->first());

        return view('front.credit_card_all', compact('banks'));
    }

    public function single($slug)
    {
        $creditCard = CreditCard::whereSlug($slug)->with('organization')->firstOrFail();
        $this->setSeo($creditCard->seo);
        $this->setJsonLd(new Product($creditCard));
        return view('front.credit_card', compact('creditCard'));
    }
}
