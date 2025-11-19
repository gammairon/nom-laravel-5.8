<?php

namespace App\Http\Controllers\Front;

use App\Entity\Organization\Mfo;
use App\Entity\Seo\Seo;
use App\UseCases\JsonLd\Organization;
use App\Http\Controllers\Controller;

class MfoController extends Controller
{

    public function all()
    {
        //$mfos = Mfo::whereNotIn('id', [97])->get();
        $this->setSeo(Seo::whereSeoeableType('mfo')->first());

        return view('front.mfo_all')->compileShortcodes();
    }

    public function single($slug)
    {
        $mfo = Mfo::whereSlug($slug)->firstOrFail();
        $this->setSeo($mfo->seo);
        $this->setJsonLd(new Organization($mfo));
        return view('front.mfo', compact('mfo'));
    }
}
