<?php
/**
 * User: Artem
 * Date: 22.09.2020
 */

namespace App\Http\ViewComposers\Nominal20;


use App\Entity\Blog\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class FeedNewsComposer
{

    public function compose(View $view)
    {

        $lastPosts = Cache::tags(['posts'])->rememberForever('last:news', function (){
            return Post::public()->defaultOrdered()->select(['slug', 'top', 'name', 'public_date'])->limit(20)->get();
        });
        return $view->with('lastPosts', $lastPosts);
    }

}
