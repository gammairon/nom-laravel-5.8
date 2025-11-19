<?php
/**
 * User: Gamma-iron
 * Date: 25.07.2019
 */

namespace App\Http\Controllers\Front;


use App\Entity\Blog\Post;
use App\Http\Controllers\Controller;
use App\UseCases\XML\XmlService;
use Spatie\MediaLibrary\Models\Media;

class RssController extends Controller
{
    //Соответсвие категорий на сайте категориям на Ukr.Net
    protected $matchCategories = [
        'finance-news' => 'Економіка',
    ];

    public function ukrNetChannel()
    {

        /*$catAtach = 14;

        $posts = Post::all();

        foreach ($posts as $post){
            $post->categories()->detach();
            $post->categories()->attach($catAtach);
        }*/

        $posts = Post::with(['categories', 'media'])->public()->select(['id', 'slug', 'name', 'public_date', 'excerpt', 'content'])->defaultOrdered()->limit(10)->get();

        return response( view('front.rss.ukr_net_rss', [
            'posts' => $posts,
            'matchCategories' => $this->matchCategories
        ]), 200, [
            'Content-Type' => 'application/xml'
        ]);

    }

}