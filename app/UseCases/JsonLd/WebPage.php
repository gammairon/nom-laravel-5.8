<?php
/**
 * User: Gamma-iron
 * Date: 01.07.2019
 */

namespace App\UseCases\JsonLd;


use App\Entity\Blog\Page;

class WebPage extends BaseJsonLd
{
    /**
     * @var App\Entity\Blog\Page
     */
    protected $page;

    /**
     * @var array
     */
    protected $schema = [
        '@context'    => 'http://schema.org',
        '@type'       => 'WebPage',
        'url'         => '',
        'name'        => '',
        'description' => '',
        "image"       => [
            "@type" => "ImageObject",
            "url"   => ""
        ],
        'publisher'   => [
            '@type' => 'Organization',
            'name'  => 'Storm Digital'
        ],
        "datePublished" => "",
        "dateModified"  => "",
    ];

    public function __construct(Page $page)
    {
        $this->page = $page;

        $this->set('url', url()->current());
        $this->set('name', $page->seo->title);
        $this->set('description', $page->seo->description);
        $this->set('datePublished', $page->public_date->format('c'));
        $this->set('dateModified', $page->updated_at->format('c'));

        if($page->hasPrimary())
            $this->set('image.url', url($page->getPrimaryUrl()));
        else
            $this->remove('image');

    }
}