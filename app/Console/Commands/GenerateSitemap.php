<?php

namespace App\Console\Commands;

use App\Entity\Blog\Category;
use App\Entity\Blog\Page;
use App\Entity\Blog\Post;
use App\Entity\Blog\Tag;
use App\Entity\Organization\Bank;
use App\Entity\Organization\Mfo;
use App\Entity\Product\CreditCard;
use App\Entity\Product\CreditCash;
use App\Entity\User\User;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends BaseSitemapGenerator
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';


    protected $rootPath = '/sitemap';

    protected $sitemapIndexPath = 'main_public/sitemap-index.xml';

    protected $sitemapMap = ['Page', 'Bank', 'Mfo', 'CreditCard', 'CreditCash'];



    /**
     * Generate page sitemap
     */
    protected function generatePageSitemap()
    {

        Page::public()->select(['slug', 'updated_at'])->chunk(49500, function ($pages, $counter){

            $tags = [];

            if($counter == 1){
                //Main Page
                $tags[] = Url::create('/');

                //News Page
                //$tags[] = Url::create('/news');

                //Search Page
                //$tags[] = Url::create('/search');

                //Banks Archive Page
                $tags[] = Url::create('/banks');

                //MFO Archive Page
                $tags[] = Url::create('/kredit-online');

                //Credit Cards Archive Page
                $tags[] = Url::create('/kreditnye-karty');

                //Credit Cash Archive Page
                $tags[] = Url::create('/kredit-nalichnymi');

            }

            $sitemapPath = $this->getSitemapPath('page_sitemap', $counter);

            foreach ($pages as $page) {
                $tags[] = Url::create('/'.$page->slug)->setLastModificationDate($page->updated_at);
            }

            $this->saveToFile($tags, $sitemapPath);
        });

    }

    /**
     * Generate posts sitemap
     */
    /*protected function generatePostSitemap()
    {

        Post::public()->select(['slug', 'updated_at'])->chunk(49500, function ($posts, $counter){

            $sitemapPath = $this->getSitemapPath('post_sitemap', $counter);

            $tags = [];

            foreach ($posts as $post) {
                $tags[] = Url::create('/'.$post->slug)->setLastModificationDate($post->updated_at);
            }

            $this->saveToFile($tags, $sitemapPath);
        });

    }*/

    /**
     * Generate category sitemap
     */
    /*protected function generateCategorySitemap()
    {
        Category::select(['slug', 'updated_at'])->chunk(49500, function ($categories, $counter){

            $sitemapPath = $this->getSitemapPath('category_sitemap', $counter);

            $tags = [];

            foreach ($categories as $category) {
                $tags[] = Url::create('/'.$category->getSlugPrefix().$category->slug)->setLastModificationDate($category->updated_at);
            }

            $this->saveToFile($tags, $sitemapPath);
        });
    }

    protected function generateTagSitemap()
    {
        Tag::select(['slug', 'updated_at'])->chunk(49500, function ($tagItems, $counter){

            $sitemapPath = $this->getSitemapPath('tag_sitemap', $counter);

            $tags = [];

            foreach ($tagItems as $tagItem) {
                $tags[] = Url::create('/'.$tagItem->getSlugPrefix().$tagItem->slug)->setLastModificationDate($tagItem->updated_at);
            }

            $this->saveToFile($tags, $sitemapPath);
        });
    }*/

/*    protected function generateAuthorSitemap()
    {
        User::select(['slug', 'updated_at'])->chunk(49500, function ($users, $counter){

            $sitemapPath = $this->getSitemapPath('author_sitemap', $counter);

            $tags = [];

            foreach ($users as $user) {
                $tags[] = Url::create('/'.$user->getSlugPrefix().$user->slug)->setLastModificationDate($user->updated_at);
            }

            $this->saveToFile($tags, $sitemapPath);
        });
    }*/

    protected function generateBankSitemap()
    {
        Bank::select(['slug', 'updated_at'])->chunk(49500, function ($banks, $counter){

            $sitemapPath = $this->getSitemapPath('bank_sitemap', $counter);

            $tags = [];

            foreach ($banks as $bank) {
                $tags[] = Url::create('/'.$bank->getSlugPrefix().$bank->slug)->setLastModificationDate($bank->updated_at);
            }

            $this->saveToFile($tags, $sitemapPath);
        });
    }

    protected function generateMfoSitemap()
    {
        Mfo::select(['slug', 'updated_at'])->chunk(49500, function ($mfos, $counter){

            $sitemapPath = $this->getSitemapPath('mfo_sitemap', $counter);

            $tags = [];

            foreach ($mfos as $mfo) {
                $tags[] = Url::create('/'.$mfo->getSlugPrefix().$mfo->slug)->setLastModificationDate($mfo->updated_at);
            }

            $this->saveToFile($tags, $sitemapPath);
        });
    }


    protected function generateCreditCardSitemap()
    {
        CreditCard::select(['slug', 'updated_at'])->chunk(49500, function ($creditCards, $counter){

            $sitemapPath = $this->getSitemapPath('credit_card_sitemap', $counter);

            $tags = [];

            foreach ($creditCards as $creditCard) {
                $tags[] = Url::create('/'.$creditCard->getSlugPrefix().$creditCard->slug)->setLastModificationDate($creditCard->updated_at);
            }

            $this->saveToFile($tags, $sitemapPath);
        });
    }

    protected function generateCreditCashSitemap()
    {
        CreditCash::select(['slug', 'updated_at'])->chunk(40000, function ($credits, $counter){

            $sitemapPath = $this->getSitemapPath('credit_cash_sitemap', $counter);

            $tags = [];

            foreach ($credits as $credit) {
                $tags[] = Url::create('/'.$credit->getSlugPrefix().$credit->slug)->setLastModificationDate($credit->updated_at);
            }

            $this->saveToFile($tags, $sitemapPath);
        });
    }
}
