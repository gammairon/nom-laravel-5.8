<?php
/**
 * User: Gamma-iron
 * Date: 16.01.2020
 */

namespace App\UseCases\Admin\Lists;


use App\Entity\Lists\ListMfo;
use App\Entity\Organization\Mfo;
use App\UseCases\Admin\Service;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ListMfoService extends Service
{
    public function create(array $data): ?ListMfo
    {
        $listMfo = new ListMfo(Arr::except($data, ['mfo_ids']));

        return $this->save($listMfo, $data);
    }

    public function update(ListMfo $listMfo, array $data): ?ListMfo
    {
        $listMfo->fill(Arr::except($data, ['mfo_ids']));

        return $this->save($listMfo, $data);
    }


    public function save(ListMfo $listMfo, array $data): ?ListMfo
    {
        return $this->transaction(function () use ($listMfo, $data){

            $listMfo->save();

            $this->syncMfo($listMfo, $data);

            return $listMfo;
        });
    }


    public function deleteItems(iterable $itemIds)
    {
        return ListMfo::destroy($itemIds);
    }

    /**
     * Возвразает два набора МФО в массиве
     * Один дефолтный набор
     * Второй набор МФО который принадлежит к определённому списку
     * @return array
     */
    public function getMfoLists($listId = 0): array
    {
        //DB::enableQueryLog();
        /*$selectedMfos = Mfo::join('list_mfo', 'mfo_org.id', '=', 'list_mfo.mfo_id')->where('list_mfo.list_id', '=', $listId)->select(['id', 'name', 'max_amount', 'repeat_credit_bid', 'min_age', 'max_age', 'free_credit_bid', 'max_term'])->orderBy('list_mfo.sort')->get();*/
        $selectedMfos = Mfo::join('list_mfo', function ($query) use ($listId){
            $query->on('mfo_org.id', 'list_mfo.mfo_id')
                ->where('list_mfo.list_id', $listId);
        })->select(['id', 'name', 'max_amount', 'repeat_credit_bid', 'min_age', 'max_age', 'free_credit_bid', 'max_term'])->orderBy('list_mfo.sort')->get();
        //dd($selectedMfos);
        //dd(DB::getQueryLog());
        $defaultMfos = Mfo::select(['id', 'name', 'max_amount', 'repeat_credit_bid', 'min_age', 'max_age', 'free_credit_bid', 'max_term'])->get();

        return [$defaultMfos, $selectedMfos];
    }

    protected function syncMfo(ListMfo $listMfo, array $data)
    {
        if(blank($data['mfo_ids']))
            return;

        $ids = explode(',', $data['mfo_ids']);

        if(!filled($ids))
            return;

        $syncMfos = [];

        foreach ($ids as $key => $id){
            $syncMfos[] = [
                'list_id' => $listMfo->id,
                'mfo_id' => $id,
                'sort' => $key
            ];
        }

        $listMfo->mfos()->detach();

        DB::table('list_mfo')->insert($syncMfos);

    }
}
