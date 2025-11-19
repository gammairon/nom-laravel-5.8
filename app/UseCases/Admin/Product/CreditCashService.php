<?php
/**
 * User: Gamma-iron
 * Date: 15.05.2019
 */

namespace App\UseCases\Admin\Product;


use App\Entity\Organization\Bank;
use App\Entity\Product\CreditCash;
use App\Entity\Product\Meta;
use App\UseCases\Admin\Service;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CreditCashService extends Service
{

    public function create(array $data): ?CreditCash
    {
        $data['organization_type'] = Bank::class;

        $creditCash = new CreditCash(Arr::except($data, ['advantages', 'primary_media', 'seo']));

        return $this->save($creditCash, $data);

    }

    public function update(CreditCash $creditCash, array $data): ?CreditCash
    {
        $creditCash->fill(Arr::except($data, ['advantages', 'primary_media', 'seo']));

        return $this->save($creditCash, $data);
    }

    protected function updateAdvantages(CreditCash $creditCash, array $advantages)
    {
        $creditCash->syncMeta('advantage', $advantages);
    }

    protected function save(CreditCash $creditCash, array $data): ?CreditCash
    {

        return $this->transaction(function () use($creditCash, $data){

            $creditCash->save();

            $this->updatePrimaryPhoto($creditCash, $data);

            $this->updateAdvantages($creditCash, Arr::get($data, 'advantages'));

            $creditCash->updateSeo($data);

            return $creditCash;
        });

    }

    public function deleteItems(iterable $itemIds)
    {
        return CreditCash::destroy($itemIds);
    }
}