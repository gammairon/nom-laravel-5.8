<?php
/**
 * User: Gamma-iron
 * Date: 03.04.2019
 */

namespace App\UseCases\Admin\Blog;


use App\Entity\Blog\Category;
use App\UseCases\Admin\Service;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class CategoryService extends Service
{

    public function create(array $data): ?Category
    {
        $category = new Category(Arr::except($data,['primary_media', 'seo']));

        return $this->save($category, $data);
    }

    public function update(Category $category, array $data): ?Category
    {
        $category->fill(Arr::except($data,['primary_media', 'seo']));

        return $this->save($category, $data);
    }


    protected function save(Category $category, array $data): ?Category
    {
        return $this->transaction(function () use ($category, $data){

            $category->save();

            $this->updatePrimaryPhoto($category, $data);

            $category->updateSeo($data);

            return $category;
        });
    }

    public function deleteItems(iterable $itemIds)
    {
        return Category::destroy($itemIds);
    }

    public function flushCache()
    {
        Cache::tags(['categories'])->flush();
    }
}