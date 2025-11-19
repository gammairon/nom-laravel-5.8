<?php
/**
 * User: Artem
 * Date: 26.07.2020
 */

namespace App\Cron;


use App\Entity\CurrencyRate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CurrencyRates
{
    private static $attempt = 0;

    public function run()
    {
        try{
            self::$attempt++;
            $this->updateNbuCurrencyRates();
            $this->updatePrivatBankCurrencyRates();
        }catch (\Exception $e){
            if(self::$attempt <= 3)
                $this->run();
            else
                Log::error('Не удалось получить Курсы Валют!!!');
        }
    }

    protected function updateNbuCurrencyRates()
    {
        $rates = $this->getNbuCurrencyRates();

        foreach ($rates as $cc => $rate){
            $currencyRate = CurrencyRate::whereCc($cc)->whereApi('nbu')->first();

            $currencyRate->update([
                'txt' => $rate->txt,
                'exchangedate' => $rate->exchangedate,
                'old_rate_buy' => $currencyRate->new_rate_buy,
                'old_rate_sale' => $currencyRate->new_rate_sale,
                'new_rate_buy' => $rate->rate,
                'new_rate_sale' => $rate->rate,
            ]);
        }
    }

    protected function getNbuCurrencyRates(): array
    {
        $rates = [];
        //
        $currencyRates = collect(json_decode(file_get_contents('https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange?date='.Carbon::now()->format('Ymd').'&json')));

        foreach (CurrencyRate::$currencyNbuCodes as $cc){
            $rates[$cc] = $currencyRates->where('cc', '=', $cc)->first();
        }

        return $rates;
    }

    protected function updatePrivatBankCurrencyRates()
    {
        $rates = $this->getPrivatBankCurrencyRates();

        foreach ($rates as $cc => $rate){
            $currencyRate = CurrencyRate::whereCc($cc)->whereApi('privat_bank')->first();

            $currencyRate->update([
                'exchangedate' => Carbon::now()->format('d.m.Y'),
                'old_rate_buy' => $currencyRate->new_rate_buy,
                'old_rate_sale' => $currencyRate->new_rate_sale,
                'new_rate_buy' => $rate->buy,
                'new_rate_sale' => $rate->sale,
            ]);
        }

    }

    protected function getPrivatBankCurrencyRates(): array
    {
        $rates = [];
        //
        $currencyRates = collect(json_decode(file_get_contents('https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5')));


        foreach (CurrencyRate::$currencyPrivatBankCodes as $cc){

            $rates[$cc] = $currencyRates->where('ccy', '=', $cc)->first();
        }

        return $rates;
    }
}
