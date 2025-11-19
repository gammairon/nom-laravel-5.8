<?php
/**
 * User: Gamma-iron
 * Date: 24.06.2019
 */

namespace App\Helpers;


use Illuminate\Support\Collection;

class Common
{

    /**
     * Grouped banks collection by first latter
     */
    public static function groupedBanks(Collection $banks)
    {
        return $banks->groupBy(function($item,$key) {
            return mb_substr($item->name, 0, 1);     //treats the name string as an array
        })->sortBy(function($item,$key){      //sorts A-Z at the top level
            return $key;
        });
    }


    /**
     * Добавляем url and SEO значения в массив.
     * Функция предназначена для ленты постов на странице поста
     * @param Collection $posts
     * @param array $loadedPosts
     * @return array
     */
    public static function groupLoadedPosts(Collection $posts, array $loadedPosts = []): array
    {
        $loadPosts = [];
        $posts->each(function ($item) use (&$loadPosts) {
            $loadPosts[$item->id] = [
                'url' => route('page_news', ['slug' => $item->slug]),
                'seo_title' => e($item->seo->title),
                'seo_description' => e($item->seo->description),
                'seo_keywords' => e($item->seo->keywords),
                'seo_canonical' => e($item->seo->canonical),
                'seo_robots' => $item->seo->getRobots(),

                'og_title' => e($item->seo->title),
                'og_description' => e($item->seo->description),
                'og_url' => e($item->seo->canonical),
            ];
        });

        return $loadedPosts + $loadPosts;
    }


}
