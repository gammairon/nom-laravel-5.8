<?php
/**
 * User: Gamma-iron
 * Date: 01.07.2019
 */

namespace App\UseCases\JsonLd;


use App\Entity\Blog\Post;

class NewsArticle extends BaseJsonLd
{

    /**
     * @var App\Entity\Blog\Post
     */
    protected $post;

    /**
     * @var array
     */
    protected $schema = [
        "@context"         => "https://schema.org",
        "@type"            => "NewsArticle",
        "mainEntityOfPage" => [
            "@type" => "WebPage",
            "@id"   => "https://example.com/my-news-article"
        ],
        "headline"         => "",
        "image"            => [],
        "datePublished"    => "",
        "dateModified"     => "",
        "author"           => [
            "@type" => "Person",
            "name"  => ""
        ],
        "publisher"        => [
            "@type" => "Organization",
            "name"  => "Storm Digital",
            "logo"  => [
                "@type" => "ImageObject",
                "url"   => ""
            ]
        ],
        "description"=> "A most wonderful article"
    ];

    public function __construct(Post $post)
    {
        $this->post = $post;

        $this->set('mainEntityOfPage.@id', url()->current());
        $this->set('headline', $post->seo->title);

        if($post->hasPrimary())
            $this->set('image.0', url($post->getPrimaryUrl()));

        $this->set('datePublished', $post->public_date->format('c'));
        $this->set('dateModified', $post->updated_at->format('c'));
        $this->set('author.name', $post->user->name);
        $this->set('publisher.logo.url', asset('/storage/images/logo.png'));
        $this->set('description', $post->seo->description);
    }
}