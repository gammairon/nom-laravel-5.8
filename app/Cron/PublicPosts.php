<?php

namespace App\Cron;


use App\Entity\Blog\Page;
use App\Entity\Blog\Post;
use Carbon\Carbon;

class PublicPosts
{


        public function __construct()
        {

        }


        public function run()
        {
            Post::wait()->where('public_date', '<=', Carbon::now())->update(['status' => Post::STATUS_PUBLIC]);
            Page::wait()->where('public_date', '<=', Carbon::now())->update(['status' => Page::STATUS_PUBLIC]);
        }
}