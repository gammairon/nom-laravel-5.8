<?php
/**
 * User: Artem
 * Date: 22.09.2020
 */

namespace App\Http\ViewComposers\Nominal20;


use App\Entity\Blog\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class LastNewsComposer
{

    public function compose(View $view)
    {

        $sidebarPosts = Cache::tags(['posts'])->remember('sidebar:news', 21600, function (){
            $category = Category::find(16);

            if($category)
                return $category->posts()->public()->select(['id', 'slug', 'name', 'views'])->defaultOrdered()->with('media')->limit(10)->get();

            return [];
        });
        return $view->with('sidebarPosts', $sidebarPosts);
    }

}
