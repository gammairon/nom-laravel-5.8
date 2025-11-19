<?php

namespace App\Http\Controllers\Front;

use App\Entity\Blog\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TagController extends Controller
{

    public function single(Request $request, $slug)
    {
        $tag = Tag::whereSlug($slug)->firstOrFail();

        $cacheKey = 'tag:'.$tag->id.':posts'.$request->input('page');

        $posts = Cache::tags(['posts'])->remember($cacheKey, 21600, function () use ($tag) {
            return $tag->posts()->with(['categories', 'user', 'tags', 'media'])->public()->defaultOrdered()->simplePaginate(config('settings.perPage'));
        });

        if($request->ajax()){
            return response()->json([
                'content' => view('front.partials.category_post', compact('posts'))->render(),
                'paginator' => $posts,
            ]);
        }

        $this->setSeo($tag->seo);
        return view('front.tag_posts', compact('posts', 'tag'));
    }
}
