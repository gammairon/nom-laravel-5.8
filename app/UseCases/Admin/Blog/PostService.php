<?php
/**
 * User: Gamma-iron
 * Date: 08.04.2019
 */

namespace App\UseCases\Admin\Blog;

use App\Entity\Blog\Post;
use App\UseCases\Admin\Service;
use Illuminate\Support\Arr;

class PostService extends Service
{

    public function create(array $data): ?Post
    {

        $post = new Post( $this->getOnlyPostData($data) );

        return $this->save($post, $data);
    }

    public function update(Post $post, array $data): ?Post
    {

        $post->fill( $this->getOnlyPostData($data) );

        return $this->save($post, $data);
    }

    protected function getOnlyPostData(array $data)
    {
        return Arr::except($data,['primary_media', 'categories', 'tags', 'seo', 'faqs']);
    }

    public function updateRelation(Post $post, array $data)
    {

        $this->updatePrimaryPhoto($post, $data);

        $post->categories()->sync(Arr::get($data, 'categories', []));

        $post->tags()->sync(Arr::get($data, 'tags', []));

        $post->updateSeo($data);

        //Update FAQ
        $post->faqs()->delete();
        $post->faqs()->createMany(Arr::get($data, 'faqs', []));
    }

    protected function save(Post $post, array $data): ?Post
    {
        return $this->transaction(function () use($post, $data){

            $post->save();

            $this->updateRelation($post, $data);

            return $post;
        });
    }


    public function deleteItems(iterable $itemIds)
    {
        return Post::destroy($itemIds);
    }
}
