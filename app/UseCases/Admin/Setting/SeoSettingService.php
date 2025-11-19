<?php
/**
 * User: Gamma-iron
 * Date: 20.06.2019
 */

namespace App\UseCases\Admin\Setting;


use App\Entity\Seo\Seo;
use App\Entity\Setting;
use App\Http\Requests\Admin\SeoRequest;
use App\UseCases\Admin\Service;


class SeoSettingService extends Service
{

    public function update(SeoRequest $request)
    {

        return $this->transaction(function () use ($request){
            return $this->updateGlobalSeo($request->input('global', []))
                && $this->updateFrontSeo($request->input('front', []))
                && $this->updateNewsSeo($request->input('news', []))
                && $this->updateCategoriesSeo($request->input('categories', []))
                && $this->updateTagsSeo($request->input('tags', []))
                && $this->updateCreditCardsSeo($request->input('credit_cards', []))
                && $this->updateCreditCashSeo($request->input('credit_cash', []))
                && $this->updateMfoSeo($request->input('mfo', []))
                && $this->updateBanksSeo($request->input('banks', []))
                && $this->updateSearchSeo($request->input('search', []));
        });

    }

    public function updateGlobalSeo(array $data)
    {
        foreach ($data as $key => $value){
            /* Setting::create([
                 'name' => $key, 'val' => $value
             ]);*/
            if(!Setting::where(['name' => $key])->update(['val' => $value]))
                return false;
        }

        return true;
    }

    public function updateFrontSeo(array $data)
    {
        return Seo::where(['seoeable_type' => Seo::FRONT_SEO])->update($data);
    }

    public function updateNewsSeo(array $data)
    {
        return Seo::where(['seoeable_type' => Seo::NEWS_SEO])->update($data);
    }

    public function updateCategoriesSeo(array $data)
    {
        return Seo::where(['seoeable_type' => Seo::CATEGORIES_SEO])->update($data);
    }

    public function updateTagsSeo(array $data)
    {
        return Seo::where(['seoeable_type' => Seo::TAGS_SEO])->update($data);
    }

    public function updateCreditCardsSeo(array $data)
    {
        return Seo::where(['seoeable_type' => Seo::CREDIT_CARDS_ARCHIVE_SEO])->update($data);
    }

    public function updateCreditCashSeo(array $data)
    {
        return Seo::where(['seoeable_type' => Seo::CREDIT_CASH_ARCHIVE_SEO])->update($data);
    }

    public function updateMfoSeo(array $data)
    {
        return Seo::where(['seoeable_type' => Seo::MFO_SEO])->update($data);
    }

    public function updateBanksSeo(array $data)
    {
        return Seo::where(['seoeable_type' => Seo::BANKS_SEO])->update($data);
    }

    public function updateSearchSeo(array $data)
    {
        return Seo::where(['seoeable_type' => Seo::SEARCH_SEO])->update($data);
    }

}