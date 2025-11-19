<?php
/**
 * User: Gamma-iron
 * Date: 26.05.2019
 */

namespace App\Http\ViewComposers;


use App\Entity\Blog\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class LastNewsComposer
{
    public function compose(View $view)
    {
        $lastPosts = Cache::tags(['posts'])->rememberForever('last:news', function (){
            return Post::public()->defaultOrdered()->select(['slug', 'top', 'name', 'public_date'])->limit(60)->get();
        });
        return $view->with('lastPosts', $lastPosts);
    }
}