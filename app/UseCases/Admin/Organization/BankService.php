<?php
/**
 * User: Gamma-iron
 * Date: 14.05.2019
 */

namespace App\UseCases\Admin\Organization;


use App\Entity\Organization\Bank;
use App\UseCases\Admin\Service;
use Illuminate\Support\Arr;

class BankService extends Service
{

    public function create(array $data): ?Bank
    {
        $bank = new Bank(Arr::except($data, ['primary_media', 'president_photo', 'seo']));

        return $this->save($bank, $data);
    }

    public function update(Bank $bank, array $data): ?Bank
    {
        $bank->fill(Arr::except($data, ['primary_media', 'president_photo', 'seo']));

        return $this->save($bank, $data);
    }

    protected function save(Bank $bank, array $data): ?Bank
    {
        return $this->transaction(function () use ($bank, $data){

            $bank->save();

            $this->updatePrimaryPhoto($bank, $data);

            $this->updatePrimaryPhoto($bank, $data, Bank::PRESIDENT_PHOTO);

            $bank->updateSeo($data);

            return $bank;
        });

    }

    public function deleteItems(iterable $itemIds)
    {
        return Bank::destroy($itemIds);
    }

}