<?php
/**
 * User: Gamma-iron
 * Date: 25.03.2020
 */

namespace App\Console\Commands;


use App\Entity\Blog\Category;
use App\Entity\Blog\Page;
use App\Entity\Blog\Post;
use App\Entity\Blog\Tag;
use App\Entity\User\User;
use Spatie\Sitemap\Tags\Url;

class GenerateNewsSitemap extends BaseSitemapGenerator
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap_news:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap for news.nominal.com.ua.';


    protected $rootPath = '/news_public/sitemap';

    protected $sitemapIndexPath = 'news_public/sitemap-index.xml';

    protected $sitemapMap = ['Post', 'Category', 'Tag', 'Author'];

    protected function parseSitemapPath($sitemapPath)
    {
        return config('app.news_url').$sitemapPath;
    }

    /**
     * Generate posts sitemap
     */
    protected function generatePostSitemap()
    {

        Post::public()->select(['slug', 'updated_at'])->chunk(49500, function ($posts, $counter){

            $sitemapPath = $this->getSitemapPath('post_sitemap', $counter);

            $tags = [];

            foreach ($posts as $post) {
                $tags[] = Url::create(config('app.news_url').'/'.$post->slug)->setLastModificationDate($post->updated_at);
            }

            $this->saveToFile($tags, $sitemapPath);
        });

    }


    /**
     * Generate category sitemap
     */
    protected function generateCategorySitemap()
    {
        Category::select(['slug', 'updated_at'])->chunk(49500, function ($categories, $counter){

            $sitemapPath = $this->getSitemapPath('category_sitemap', $counter);

            $tags = [];

            foreach ($categories as $category) {
                $tags[] = Url::create(config('app.news_url').'/'.$category->getSlugPrefix().$category->slug)->setLastModificationDate($category->updated_at);
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
                $tags[] = Url::create(config('app.news_url').'/'.$tagItem->getSlugPrefix().$tagItem->slug)->setLastModificationDate($tagItem->updated_at);
            }

            $this->saveToFile($tags, $sitemapPath);
        });
    }

    protected function generateAuthorSitemap()
    {
        User::select(['slug', 'updated_at'])->chunk(49500, function ($users, $counter){

            $sitemapPath = $this->getSitemapPath('author_sitemap', $counter);

            $tags = [];

            foreach ($users as $user) {
                $tags[] = Url::create(config('app.news_url').'/'.$user->getSlugPrefix().$user->slug)->setLastModificationDate($user->updated_at);
            }

            $this->saveToFile($tags, $sitemapPath);
        });
    }
}
