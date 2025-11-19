<?php
/**
 * User: Gamma-iron
 * Date: 01.07.2019
 */

namespace App\UseCases\JsonLd;


use App\Entity\Product\CreditCard;
use App\Entity\Product\CreditCash;

class Product extends BaseJsonLd
{

    /**
     * @var array
     */
    protected $schema = [
        "@context"          => "https://www.schema.org",
        "@type"             => "product",
        "brand"             => "",
        "logo"              => "",
        "name"              => "",
        "category"          => "",
        "image"             => "",
        "description"       => "",

        "aggregateRating"   => [
            "@type"       => "aggregateRating",
            "ratingValue" => "",
            "reviewCount" => "100"
        ]
    ];

    public function __construct($model)
    {
        if (get_class($model) == CreditCard::class)
            $this->generateForCreditCard($model);

        if (get_class($model) == CreditCash::class)
            $this->generateForCreditCash($model);
    }



    public function generateForCreditCard(CreditCard $creditCard)
    {
        $this->set('brand', $creditCard->organization->name);

        if($creditCard->hasPrimary()){
            $this->set('logo', url($creditCard->getPrimaryUrl()));
            $this->set('image', url($creditCard->getPrimaryUrl()));
        }
        else{
            $this->remove('logo');
            $this->remove('image');
        }

        $this->set('name', $creditCard->name);
        $this->set('category', 'Кредитные карты');
        $this->set('description', $creditCard->seo->description);

        $this->set('aggregateRating.ratingValue', $creditCard->rating);
    }

    public function generateForCreditCash(CreditCash $creditCash)
    {
        $this->set('brand', $creditCash->organization->name);

        if($creditCash->hasPrimary()){
            $this->set('logo', url($creditCash->getPrimaryUrl()));
            $this->set('image', url($creditCash->getPrimaryUrl()));
        }
        else{
            $this->remove('logo');
            $this->remove('image');
        }

        $this->set('name', $creditCash->name);
        $this->set('category', 'Кредиты наличными');
        $this->set('description', $creditCash->seo->description);

        $this->set('aggregateRating.ratingValue', $creditCash->rating);
    }
}