<?php

namespace App\Http\Controllers\Front;


use App\Entity\Product\CreditCash;
use App\Entity\Seo\Seo;
use App\UseCases\JsonLd\Product;
use App\Http\Controllers\Controller;

class CreditCashController extends Controller
{


    public function all()
    {
        $creditsCash = CreditCash::with('organization')->orderByDesc('rating')->get();
        $this->setSeo(Seo::whereSeoeableType('credit_cash_archive')->first());

        $min_amount = CreditCash::min('min_amount');
        $max_amount = CreditCash::max('max_amount');
        $min_term = CreditCash::min('min_term');
        $max_term = CreditCash::max('max_term');

        return view('front.credit_cash_all', compact('creditsCash', 'min_amount', 'max_amount', 'min_term', 'max_term'));
    }

    public function single($slug)
    {
        $creditCash = CreditCash::whereSlug($slug)->with('organization')->firstOrFail();
        $this->setSeo($creditCash->seo);
        $this->setJsonLd(new Product($creditCash));
        return view('front.credit_cash', compact('creditCash'));
    }
}
