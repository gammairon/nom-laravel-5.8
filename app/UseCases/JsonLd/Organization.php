<?php
/**
 * User: Gamma-iron
 * Date: 01.07.2019
 */

namespace App\UseCases\JsonLd;


use App\Entity\Organization\Bank;
use App\Entity\Organization\Mfo;
use Illuminate\Database\Eloquent\Model;

class Organization extends BaseJsonLd
{

    /**
     * @var array
     */
    protected $schema = [
        "@context"      => "https://schema.org",
        "@type"         => "Organization",
        "name"          => "",
        "legalName"     => "",
        "url"           => "",
        "logo"          => "",
        "foundingDate"  => "",

        "founder"      => [
            "@type" => "Person",
            "name"  => ""
        ],

        /*"address"       => [
            "@type"           => "PostalAddress",
            "streetAddress"   => "900 Linton Blvd Suite 104",
            "addressLocality" => "Delray Beach",
            "addressRegion"   => "FL",
            "postalCode"      => "33444",
            "addressCountry"  => "USA"
        ],*/

        "contactPoint"  => [
            "@type"       => "ContactPoint",
            "contactType" => "customer support",
            "telephone"   => "",
            "email"       => ""
        ],

        "aggregateRating"   => [
            "@type"       => "aggregateRating",
            "ratingValue" => "",
            "reviewCount" => "100",
            "bestRating"  => "10"
        ],

        /*"sameAs"        => [
            "http://www.freebase.com/m/0_h96pq",
            "http://www.facebook.com/elitestrategies",
            "http://www.twitter.com/delraybeachseo",
            "http://pinterest.com/elitestrategies/",
            "http://elitestrategies.tumblr.com/",
            "http://www.linkedin.com/company/elite-strategies",
            "https://plus.google.com/106661773120082093538"
        ]*/
    ];

    public function __construct($model)
    {
        if (get_class($model) == Bank::class)
            $this->generateForBank($model);

        if (get_class($model) == Mfo::class)
            $this->generateForMfo($model);
    }


    public function generateForBank(Bank $bank)
    {
        $this->set('name', $bank->name);
        $this->set('legalName', $bank->name);
        $this->set('url', $bank->web_site);

        if($bank->hasPrimary())
            $this->set('logo', url($bank->getPrimaryUrl()));
        else
            $this->remove('logo');

        if($bank->date_reg)
            $this->set('foundingDate', $bank->date_reg->format('Y'));

        $this->set('founder.name', $bank->president_name);

        $this->set('contactPoint.telephone', $bank->phone);
        $this->set('contactPoint.email', $bank->email);

        $this->set('aggregateRating.ratingValue', $bank->rating);

    }

    public function generateForMfo(Mfo $mfo)
    {
        $this->set('name', $mfo->name);
        $this->set('legalName', $mfo->name);
        $this->set('url', $mfo->ref_link);

        if($mfo->hasPrimary())
            $this->set('logo', url($mfo->getPrimaryUrl()));
        else
            $this->remove('logo');


        $this->remove('foundingDate');

        $this->remove('founder');

        $this->set('contactPoint.telephone', $mfo->phone);
        $this->set('contactPoint.email', $mfo->email);

        $this->set('aggregateRating.ratingValue', $mfo->rating);
    }
}
