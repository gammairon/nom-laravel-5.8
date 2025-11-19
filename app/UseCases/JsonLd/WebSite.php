<?php
/**
 * User: Gamma-iron
 * Date: 01.07.2019
 */

namespace App\UseCases\JsonLd;


use App\Entity\Setting;

class WebSite extends BaseJsonLd
{

    protected $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        '@id' => '#website',
        'url' => '',
        'name' => '',
        'thumbnailUrl' => '',
        'publisher' => [
            '@type' => 'Organization',
            'name' => 'Storm Digital'
        ],
        'author' => [
            '@type' => 'Organization',
            'name' => 'Storm Digital'
        ]
    ];

    public function __construct()
    {
        $this->set('thumbnailUrl', asset('/storage/images/logo.png'));

        $this->set('name', Setting::getSiteName());

        $this->set('url', url()->current());
    }
}