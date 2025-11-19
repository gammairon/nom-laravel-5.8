<?php

namespace App\Http\Controllers;


use App\Entity\Blog\Category;
use App\Entity\Blog\Page;
use App\Entity\Blog\Post;
use App\Entity\CurrencyRate;
use App\Entity\Organization\Mfo;
use App\Entity\Seo\Seo;
use App\Entity\Weather;
use App\Helpers\Common;
use App\UseCases\CurrencyRateService;
use App\UseCases\Front\PageService;
use App\UseCases\JsonLd\NewsArticle;
use App\UseCases\JsonLd\WebSite;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Lullabot\AMP\AMP;
use Illuminate\Support\Facades\URL;
use Spatie\MediaLibrary\ImageGenerators\FileTypes\Webp;

class HomeController extends Controller
{

    protected $pageService;

    protected $amp;

    public function __construct(PageService $service, AMP $amp)
    {
        $this->pageService = $service;

        $this->amp = $amp;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //Cache::flush();
        /*$topPosts = Cache::tags(['posts'])->rememberForever('front:top:posts', function (){
            return Post::whereTop(1)->public()->select(['id', 'slug', 'name'])->with(['media'])->defaultOrdered()->limit(5)->get();
        });

        $finPosts = Cache::tags(['posts'])->remember('front:fin:posts', 21600, function (){
            return Category::find(14)->posts()->public()->select(['id', 'slug', 'name', 'public_date', 'views', 'excerpt'])->defaultOrdered()->with(['media'])->limit(12)->get();
        });

        $this->setSeo(Seo::whereSeoeableType('front')->first());

        $this->setJsonLd(new WebSite());

        return view('front.home', compact('topPosts', 'finPosts'));*/
        $topPosts = Cache::tags(['posts'])->rememberForever('front:top:posts', function (){
            return Post::public()->select(['id', 'slug', 'name'])->with(['media', 'categories'])->defaultOrdered()->limit(13)->get();
        });

        $finPosts = Cache::tags(['posts'])->remember('front:fin:posts', 21600, function (){
            return Category::find(14)->posts()->public()->select(['id', 'slug', 'name', 'public_date', 'views', 'excerpt', 'top'])->defaultOrdered()->with(['media'])->limit(38)->get();
        });

        $mostReadingPosts = Cache::tags(['posts'])->remember('front:reading:posts', 21600, function (){
            return Post::public()->select(['id', 'slug', 'name', 'views', 'public_date'])->where('public_date', '>',  Carbon::now()->subWeeks(2))->orderBy('views', 'DESC')->limit(10)->get();
        });

        $mfos = Mfo::with(['media'])->orderBy('rating', 'DESC')->limit(9)->get()->chunk(3);

        $this->setSeo(Seo::whereSeoeableType('front')->first());

        $this->setJsonLd(new WebSite());

        $currencyRateService = new CurrencyRateService(CurrencyRate::all());

        return view('nominal20.home', compact('topPosts', 'finPosts', 'mostReadingPosts', 'mfos', 'currencyRateService'));
    }

    public function referral(Request $request)
    {

        $mfoId = $request->get('mfo');

        if($mfoId){
            $mfo = Mfo::find($mfoId);

            return redirect($mfo->ref_link);
        }
        else{
            return back();
        }


    }



    public function show($slug)
    {
        return $this->pageService->getView($slug);
    }

    public function showPost($slug)
    {
        return $this->pageService->getView($slug);
    }

    public  function showAmp($slug)
    {
        $post = $this->pageService->getPost($slug);
        $this->pageService->setAdditionData($post);
        $this->setJsonLd(new NewsArticle($post));
        $this->amp->loadHtml($post->content);
        return view('front.amp.post', [
            'post' => $post,
            'ampContent' => $this->amp->convertToAmpHtml()
        ]);
    }

    public function search(Request $request)
    {
        $query = Post::with(['categories', 'user', 'tags', 'media'])->public()->select(['id', 'slug', 'name', 'public_date', 'views', 'excerpt'])->defaultOrdered();

        if($search = $request->input('s')){
            $query->where('name', 'like', '%'.$search.'%');
            $posts = $query->paginate(config('settings.perPage'));
        }
        else{
            $posts = collect([]);
        }

        $this->setSeo(Seo::whereSeoeableType(Seo::SEARCH_SEO)->first());

        $this->setJsonLd(new WebSite());

        return view('front.search', compact('posts'));
    }

    public function iformer()
    {
        return view('front.ad.informer37905');
    }



    /*=========================================================================================================================================*/
    /*=========================================================================================================================================*/
    /*=========================================================================================================================================*/
    /*=========================================================================================================================================*/
    /*=========================================================================================================================================*/
    /*=========================================================================================================================================*/
    /*=========================================================================================================================================*/
    public function getPost(string $slug): ?Post
    {
        $post = Post::whereSlug($slug)->public()->firstOrFail();

        return Cache::tags(['posts'])->remember('single:post:'.$post->id, 21600, function () use ($post){
            return $post->load(['categories', 'user', 'tags', 'media', 'seo']);
        });
    }

    public function setAdditionData(Model $model)
    {
        $model->increment('views');
        $this->setSeo($model->seo, $model);
    }

    public function customTestPage(Request $request)
    {
        return view('nominal20.landings.kredit_kassa');
        /*$topPosts = Cache::tags(['posts'])->rememberForever('front:top:posts', function (){
            return Post::public()->select(['id', 'slug', 'name'])->with(['media', 'categories'])->defaultOrdered()->limit(13)->get();
        });

        $finPosts = Cache::tags(['posts'])->remember('front:fin:posts', 21600, function (){
            return Category::find(14)->posts()->public()->select(['id', 'slug', 'name', 'public_date', 'views', 'excerpt', 'top'])->defaultOrdered()->with(['media'])->limit(38)->get();
        });

        $mostReadingPosts = Cache::tags(['posts'])->remember('front:reading:posts', 21600, function (){
            return Post::public()->select(['id', 'slug', 'name', 'views', 'public_date'])->where('public_date', '>',  Carbon::now()->subWeeks(2))->orderBy('views', 'DESC')->limit(10)->get();
        });

        $mfos = Mfo::with(['media'])->orderBy('rating', 'DESC')->limit(9)->get()->chunk(3);

        $this->setSeo(Seo::whereSeoeableType('front')->first());

        $this->setJsonLd(new WebSite());

        $currencyRateService = new CurrencyRateService(CurrencyRate::all());

        return view('nominal20.home', compact('topPosts', 'finPosts', 'mostReadingPosts', 'mfos', 'currencyRateService'));*/

        /*DB::table('currency_rates')->insert([
            ['api' => 'nbu', 'txt' => 'Доллар', 'cc' => 'USD', 'exchangedate' => '26.07.2020', 'old_rate' => 0.00, 'new_rate' => 0.00, 'ordered' => 1],
            ['api' => 'nbu', 'txt' => 'Евро', 'cc' => 'EUR', 'exchangedate' => '26.07.2020', 'old_rate' => 0.00, 'new_rate' => 0.00, 'ordered' => 2],
            ['api' => 'nbu', 'txt' => 'Рубль', 'cc' => 'RUB', 'exchangedate' => '26.07.2020', 'old_rate' => 0.00, 'new_rate' => 0.00, 'ordered' => 3],
            ['api' => 'privat_bank', 'txt' => 'Доллар', 'cc' => 'USD', 'exchangedate' => '26.07.2020', 'old_rate' => 0.00, 'new_rate' => 0.00, 'ordered' => 1],
            ['api' => 'privat_bank', 'txt' => 'Евро', 'cc' => 'EUR', 'exchangedate' => '26.07.2020', 'old_rate' => 0.00, 'new_rate' => 0.00, 'ordered' => 2],
            ['api' => 'privat_bank', 'txt' => 'Рубль', 'cc' => 'RUB', 'exchangedate' => '26.07.2020', 'old_rate' => 0.00, 'new_rate' => 0.00, 'ordered' => 3],
        ]);*/

        /*$ratesApi = new CurrencyRates();

        $ratesApi->run();*/



        /*$posts = Post::where('content', 'like', '%https://nominal.com.ua/%')->get();
        foreach ( $posts as $post) {
            dump($post->content);
        }*/
        //Update SEO canonical
        /*$seos = Seo::where('seoeable_type', '=', 'App\Entity\Blog\Post')->get();

        foreach ($seos as $seo) {
            $seo->update(['canonical' => str_replace('nominal.com.ua', 'news.nominal.com.ua', $seo->canonical)]);
        }
        dd('End');*/
        /*$seos = Seo::all();
        foreach ($seos as $key => $seo){
            if($seo->seoeable_id == 0)
                continue;

            if(is_null($seo->seoeable)){
                $seo->delete();
                continue;
            }


            $path = '/'.$seo->seoeable->getSlugPrefix().$seo->seoeable->slug;
            $canonical = url( $path );

            $seo->update(['canonical' => $canonical]);

        }*/
        /*$posts = Post::with(['seo'])->get();

        foreach ($posts as $post){
            if(empty($post->seo->description)){
                //$post->seo->update(['description' => $post->excerpt]);
            }
        }*/
        /*$page = Page::find(53);

        $media = $page->getPrimary();
        $dataImg = file_get_contents($media->getPath());

        $im = imagecreatefromstring($dataImg);
        if ($im !== false) {
            //header('Content-Type: image/png');
            $path = public_path('photos/test.webp');
            //dd($path);
            imagewebp($im, $path, 60);
            imagedestroy($im);
        }
        else {
            echo 'Произошла ошибка.';
        }
        dd($im);*/


    }

}
