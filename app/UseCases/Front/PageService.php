<?php
/**
 * User: Gamma-iron
 * Date: 24.05.2019
 */

namespace App\UseCases\Front;


use App\Entity\Blog\Page;
use App\Entity\Blog\Post;
use App\Helpers\Common;
use App\Traits\SeoServiceTrait;
use App\UseCases\BaseService;
use App\UseCases\JsonLd\NewsArticle;
use App\UseCases\JsonLd\WebPage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class PageService extends BaseService
{
    use SeoServiceTrait;

    public function getView($slug)
    {
        $slug = $this->getSlug($slug);

        if($page = $this->getPage($slug)){
            $this->setAdditionData($page);
            $this->setJsonLd(new WebPage($page));
            return view('front.page', compact('page'))->compileShortcodes();
        }


        if($post = $this->getPost($slug)){
            $posts = Cache::tags(['posts'])->remember('single:posts:'.$post->id, 21600, function () use ($post){
                return Post::with(['categories', 'user', 'tags', 'media', 'seo'])
                    ->where('id', '<>', $post->id)
                    ->where('public_date', '<', $post->public_date)
                    ->defaultOrdered()
                    ->limit(2)->get();
            });

            $posts = collect();

            $loadedPosts = Common::groupLoadedPosts($posts->add($post));

            //Удаляем текущий пост из колекции
            $posts->pop();

            $this->setAdditionData($post);
            $this->setJsonLd(new NewsArticle($post));
            return view('nominal20.blog.post', compact('post', 'posts', 'loadedPosts'))->compileShortcodes();
        }

        abort(404);
    }

    protected function parseSlug(string $slug): array
    {

        /*if(strpos(trim($slug, '/'), '/') === false)
            return [$slug];

        return explode('/', $slug);*/
        return [$slug];
    }

    protected function getSlug(string $slug): string
    {
        $parts =  $this->parseSlug($slug);

        return array_pop($parts);
    }

    public function getPost(string $slug): ?Post
    {
        $post = Post::whereSlug($slug)->public()->firstOrFail();

        return Cache::tags(['posts'])->remember('single:post:'.$post->id, 21600, function () use ($post){
            return $post->load(['categories', 'user', 'tags', 'media', 'seo']);
        });
    }

    protected function getPage(string $slug): ?Page
    {
        return Page::whereSlug($slug)->public()->with(['media', 'seo', 'faqs'])->first();
    }

    public function setAdditionData(Model $model)
    {
        $model->increment('views');
        $this->setSeo($model->seo, $model);
    }


}
