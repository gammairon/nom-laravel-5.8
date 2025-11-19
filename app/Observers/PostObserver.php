<?php

namespace App\Observers;

use App\Entity\Blog\Post;
use Illuminate\Support\Facades\Cache;

class PostObserver
{

    public function saved(Post $post)
    {
        $this->clearCache();
    }

    public function deleted(Post $post)
    {
        $this->clearCache();
    }

    protected function clearCache()
    {
        Cache::tags(['posts'])->flush();
    }
}
