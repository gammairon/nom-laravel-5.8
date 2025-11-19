<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Seo\Seo;
use App\Entity\Setting;
use App\Http\Requests\Admin\SeoRequest;
use App\UseCases\Admin\Setting\SeoSettingService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class SeoController extends Controller
{
    protected $service;

    public function __construct(SeoSettingService $service)
    {
        $this->service = $service;
    }

    public function edit()
    {
        $siteName = Setting::whereName('site_name')->select(['val'])->first();
        $siteDescription = Setting::whereName('site_description')->select(['val'])->first();

        $frontSeo = Seo::firstOrNew(['seoeable_type' => Seo::FRONT_SEO]);
        $newsSeo = Seo::firstOrNew(['seoeable_type' => Seo::NEWS_SEO]);
        $categoriesSeo = Seo::firstOrNew(['seoeable_type' => Seo::CATEGORIES_SEO]);
        $tagsSeo = Seo::firstOrNew(['seoeable_type' => Seo::TAGS_SEO]);
        $creditCardsSeo = Seo::firstOrNew(['seoeable_type' => Seo::CREDIT_CARDS_ARCHIVE_SEO]);
        $creditCashSeo = Seo::firstOrNew(['seoeable_type' => Seo::CREDIT_CASH_ARCHIVE_SEO]);
        $mfoSeo = Seo::firstOrNew(['seoeable_type' => Seo::MFO_SEO]);
        $banksSeo = Seo::firstOrNew(['seoeable_type' => Seo::BANKS_SEO]);
        $search = Seo::firstOrNew(['seoeable_type' => Seo::SEARCH_SEO]);
        return view('admin.seo', compact('siteName', 'siteDescription','frontSeo', 'newsSeo', 'categoriesSeo', 'tagsSeo', 'creditCardsSeo', 'creditCashSeo', 'mfoSeo', 'banksSeo', 'search'));
    }

    public function update(SeoRequest $request)
    {
       if($this->service->update($request)){
           $request->session()->flash('success', 'Seo updated successfully!');
           Cache::tags(['settings'])->flush();
       } else {
           $request->session()->flash('error', 'Update failed. Try again!');
       }

       return back();
    }
}
