<?php
/**
 * User: Gamma-iron
 * Date: 17.04.2019
 */

namespace App\UseCases\Admin\Organization;


use App\Entity\Organization\Mfo;
use App\UseCases\Admin\Service;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class MfoService extends Service
{

    public function create(array $data): ?Mfo
    {
        $mfo = new Mfo(Arr::except($data, ['primary_media', 'seo']));

        return $this->save($mfo, $data);
    }

    public function update(Mfo $mfo, array $data): ?Mfo
    {
        $mfo->fill(Arr::except($data, ['primary_media', 'seo']));

        return $this->save($mfo, $data);
    }


    public function save(Mfo $mfo, array $data): ?Mfo
    {
        return $this->transaction(function () use ($mfo, $data){

            $mfo->save();

            $this->updatePrimaryPhoto($mfo, $data);

            $mfo->updateSeo($data);

            return $mfo;
        });
    }


    public function deleteItems(iterable $itemIds)
    {
        return Mfo::destroy($itemIds);
    }

}