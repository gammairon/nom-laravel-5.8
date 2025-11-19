<?php
/**
 * User: Gamma-iron
 * Date: 08.04.2019
 */

namespace App\UseCases\Admin\Blog;


use App\Entity\Blog\Tag;
use App\UseCases\Admin\Service;
use Illuminate\Support\Arr;


class TagService extends Service
{
    public function create(array $data): ?Tag
    {
        $tag = new Tag(Arr::except($data,['primary_media', 'seo']));

        return $this->save($tag, $data);
    }

    public function update(Tag $tag, array $data): ?Tag
    {

        $tag->fill(Arr::except($data,['primary_media', 'seo']));

        return $this->save($tag, $data);
    }

    protected function save(Tag $tag, array $data): ?Tag
    {
        return $this->transaction(function () use($tag, $data){

            $tag->save();

            $this->updatePrimaryPhoto($tag, $data);

            $tag->updateSeo($data);

            return $tag;
        });
    }

    public function deleteItems(iterable $itemIds)
    {
        return Tag::destroy($itemIds);
    }
}