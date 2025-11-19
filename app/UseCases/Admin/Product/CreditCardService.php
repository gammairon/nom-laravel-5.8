<?php
/**
 * User: Gamma-iron
 * Date: 16.05.2019
 */

namespace App\UseCases\Admin\Product;


use App\Entity\Organization\Bank;
use App\Entity\Product\CreditCard;
use App\Entity\Product\Meta;
use App\UseCases\Admin\Service;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CreditCardService extends Service
{
    public function create(array $data): ?CreditCard
    {
        $data['organization_type'] = Bank::class;

        $creditCard = new CreditCard(Arr::except($data, ['advantages', 'primary_media', 'seo']));

        return $this->save($creditCard, $data);

    }

    public function update(CreditCard $creditCard, array $data): ?CreditCard
    {
        $creditCard->fill(Arr::except($data, ['advantages', 'primary_media', 'seo']));

        return $this->save($creditCard, $data);
    }

    protected function updateAdvantages(CreditCard $creditCard, array $advantages)
    {
        $creditCard->syncMeta('advantage', $advantages);
    }

    protected function save(CreditCard $creditCard, array $data): ?CreditCard
    {


        return $this->transaction(function () use($creditCard, $data){

            $creditCard->save();

            $this->updatePrimaryPhoto($creditCard, $data);

            $this->updateAdvantages($creditCard, Arr::get($data, 'advantages'));

            $creditCard->updateSeo($data);

            return $creditCard;
        });

    }

    public function deleteItems(iterable $itemIds)
    {
        return CreditCard::destroy($itemIds);
    }
}