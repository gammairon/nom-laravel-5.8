<?php
/**
 * User: Artem
 * Date: 26.07.2020
 */

namespace App\UseCases;


use App\Entity\CurrencyRate;
use Illuminate\Database\Eloquent\Collection;

class CurrencyRateService
{
    const CC_USD = "USD";
    const CC_EUR = "EUR";
    const CC_RUB = "RUB";
    const CC_RUR = "RUR";

    const API_NBU = 'nbu';
    const API_PRIVAT_BANK = 'privat_bank';

    protected $rates;


    public  function __construct(Collection $rates)
    {
        $this->rates = $rates;
    }

    public function getBuyRate(string $api, string $cc)
    {
        $rate = $this->rates->where('api', $api)->where('cc', $cc)->first();

        if(!$rate instanceof CurrencyRate)
            return 0.00;

        return $this->parseNumberFormat($rate->new_rate_buy);
    }

    public function getSaleRate(string $api, string $cc)
    {
        $rate = $this->rates->where('api', $api)->where('cc', $cc)->first();

        if(!$rate instanceof CurrencyRate)
            return 0.00;

        return $this->parseNumberFormat($rate->new_rate_sale);
    }

    public function getBuyDifferenceRate(string $api, string $cc)
    {
        $rate = $this->rates->where('api', $api)->where('cc', $cc)->first();

        if(!$rate instanceof CurrencyRate)
            return 0.00;

        $diff = $rate->new_rate_buy - $rate->old_rate_buy;

        return $this->parseNumberFormat($diff);

    }

    public function isUpBuyRate(string $api, string $cc)
    {
        $rate = $this->rates->where('api', $api)->where('cc', $cc)->first();

        if(!$rate instanceof CurrencyRate)
            return true;

        $diff = $rate->new_rate_buy - $rate->old_rate_buy;

        return $diff >= 0;
    }

    public function getSaleDifferenceRate(string $api, string $cc)
    {
        $rate = $this->rates->where('api', $api)->where('cc', $cc)->first();

        if(!$rate instanceof CurrencyRate)
            return 0.00;

        $diff = $rate->new_rate_sale - $rate->old_rate_sale;

        return $this->parseNumberFormat($diff);
    }

    public function isUpSaleRate(string $api, string $cc)
    {
        $rate = $this->rates->where('api', $api)->where('cc', $cc)->first();

        if(!$rate instanceof CurrencyRate)
            return true;

        $diff = $rate->new_rate_sale - $rate->old_rate_sale;

        return $diff >= 0;
    }


    protected function parseNumberFormat($number)
    {
        return number_format($number, 2, ',', ' ');
    }
}
