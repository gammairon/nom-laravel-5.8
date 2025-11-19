<?php
/**
 * User: Gamma-iron
 * Date: 26.05.2019
 */

namespace App\Http\ViewComposers;


use App\Entity\Blog\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class SidebarNewsComposer
{

    public function compose(View $view)
    {
        $sidebarPosts = Cache::tags(['posts'])->remember('sidebar:news', 21600, function (){
            $category = Category::find(14);

            if($category)
                return $category->posts()->public()->select(['id', 'slug', 'name', 'views'])->defaultOrdered()->with('media')->limit(10)->get();

            return [];
        });
        return $view->with('sidebarPosts', $sidebarPosts);
    }
}