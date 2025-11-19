<?php
/**
 * User: Gamma-iron
 * Date: 25.03.2020
 */

namespace App\Console\Commands;


use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\Tags\Url;

abstract class BaseSitemapGenerator extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = '';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';


    protected $rootPath = '';

    protected $sitemapIndexPath = '';

    protected $sitemapPathes = [];

    protected $sitemapMap = [];


    /**
     * Execute the console command.
     *
     */
    public function handle()
    {

        foreach ($this->sitemapMap as $sitemapName) {
            $this->{'generate'.$sitemapName.'Sitemap'}();
        }

        $sitemapIndex = SitemapIndex::create();

        foreach ($this->sitemapPathes as $sitemapPath) {
            $sitemapIndex->add($sitemapPath);
        }

        $sitemapIndex->writeToFile(public_path($this->sitemapIndexPath));
    }


    protected function getSitemapPath($name, $counter)
    {
        $sitemapPath = $this->rootPath.'/'.$name;

        return $counter > 1 ? $sitemapPath.'_'.($counter - 1).'.xml' : $sitemapPath.'.xml' ;
    }


    protected  function saveToFile(array $tags, $sitemapPath)
    {
        $sitemap = Sitemap::create();

        foreach ($tags as $tag) {
            $sitemap->add($tag);
        }

        $sitemap->writeToFile(public_path($sitemapPath));

        $this->sitemapPathes[] = $this->parseSitemapPath($sitemapPath);
    }


    /**
     * Для возможности обработки URL sitemap в дочерных класах
     * @param $sitemapPath
     */
    protected function parseSitemapPath($sitemapPath)
    {
        return $sitemapPath;
    }

}
