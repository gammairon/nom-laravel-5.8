<?php
/**
 * User: Gamma-iron
 * Date: 02.04.2019
 */

namespace App\UseCases\Admin\Blog;


use App\Entity\Blog\Page;
use App\UseCases\Admin\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class PageService extends Service
{

    public function create(array $data): ?Page
    {
        $page = new Page($this->getOnlyPageData($data));

        return $this->save($page, $data);
    }

    public function update(Page $page, array $data): ?Page
    {
        $page->fill($this->getOnlyPageData($data));

        return $this->save($page, $data);
    }

    protected function getOnlyPageData(array $data)
    {
        return Arr::except($data,['primary_media', 'seo', 'faqs']);
    }

    protected  function save(Page $page, array $data): ?Page
    {
        return $this->transaction(function () use($page, $data){

            $page->save();

            $this->updatePrimaryPhoto($page, $data);

            $page->updateSeo($data);

            //Update FAQ
            $page->faqs()->delete();
            $page->faqs()->createMany(Arr::get($data, 'faqs', []));

            return $page;

        });
    }

    public function deleteItems(iterable $itemIds)
    {
        return Page::destroy($itemIds);
    }

}
