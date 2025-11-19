<?php

namespace App\Http\Controllers\Front;


use App\Entity\User\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class AuthorController extends Controller
{

    public function single(Request $request, $slug)
    {
        $author = User::whereSlug($slug)->firstOrFail();

        $cacheKey = 'author:'.$author->id.':posts'.$request->input('page');

        $posts = Cache::tags(['posts'])->remember($cacheKey, 21600, function () use ($author) {
            return $author->posts()->with(['categories', 'user', 'tags', 'media'])->public()->defaultOrdered()->simplePaginate(config('settings.perPage'));
        });
        
        if($request->ajax()){
            return response()->json([
                'content' => view('front.partials.category_post', compact('posts'))->render(),
                'paginator' => $posts,
            ]);
        }

        //SEO=================================
        //$this->addSeoRegex(['%%author_name%%' => $author->name]);
        //$this->setSeo(Seo::whereSeoeableType(Seo::AUTHOR_ARCHIVE_SEO)->first());
        $this->setSeo($author->seo);


        //Render
        return view('front.author_posts', compact('posts', 'author'));
    }
}