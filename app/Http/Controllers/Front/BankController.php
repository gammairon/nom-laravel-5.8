<?php

namespace App\Http\Controllers\Front;

use App\Entity\Organization\Bank;
use App\Entity\Seo\Seo;
use App\Helpers\Common;
use App\UseCases\JsonLd\Organization;
use App\Http\Controllers\Controller;

class BankController extends Controller
{

    public function all()
    {
        $banks = Bank::with('media')->get();

        $groupedBanks = Common::groupedBanks($banks);

        $this->setSeo(Seo::whereSeoeableType('banks')->first());
        return view('front.banks_all', ['banks' => $groupedBanks]);
    }

    public function single($slug)
    {
        $bank = Bank::with(['comments' => function($query){
            return $query->public()->with('parent')->orderByDesc('created_at');
        }, 'media'])->whereSlug($slug)->firstOrFail();
        $this->setSeo($bank->seo, $bank);
        $this->setJsonLd(new Organization($bank));
        return view('front.bank', compact('bank'));
    }
}
