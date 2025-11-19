<?php

namespace App\Http\Controllers\Front;

use App\Entity\Blog\Category;
use App\Entity\Blog\Post;
use App\Entity\Seo\Seo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{

    public function all(Request $request)
    {
        $cacheKey = 'all:posts'.$request->input('page');

        $posts = Cache::tags(['posts'])->remember($cacheKey, 21600, function (){
            return Post::with(['categories', 'user', 'tags', 'media'])->public()->select(['id', 'slug', 'name', 'public_date', 'views', 'excerpt'])->defaultOrdered()->simplePaginate(config('settings.perPage'));
        });

        if($request->ajax()){
            return response()->json([
                'content' => view('front.partials.category_post', compact('posts'))->render(),
                'paginator' => $posts,
            ]);
        }

        $this->setSeo(Seo::whereSeoeableType('news')->first());

        return view('front.category_all', compact('posts'));
    }

    public function single(Request $request, $slug)
    {
        $category = Category::whereSlug($slug)->firstOrFail();

        $cacheKey = 'category:'.$category->id.':posts'.$request->input('page');

        $posts = Cache::tags(['posts'])->remember($cacheKey, 21600, function () use ($category){
            return $category->posts()->with(['categories', 'user', 'tags', 'media'])->public()->select(['id', 'slug', 'name', 'public_date', 'views', 'excerpt'])->defaultOrdered()->simplePaginate(config('settings.perPage'));
        });

        if($request->ajax()){
            return response()->json([
                'content' => view('front.partials.category_post', compact('posts'))->render(),
                'paginator' => $posts,
            ]);
        }

        $this->setSeo($category->seo);

        return view('front.category_all', compact('posts', 'category'));
    }
}
