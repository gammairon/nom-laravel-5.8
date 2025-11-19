<?php
/**
 * User: Artem
 * Date: 26.07.2020
 */

namespace App\Cron;


use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Entity\Weather as WeatherEntity;

class Weather
{
    private static $attempt = 0;

    public function run()
    {
        try{
            self::$attempt++;
            $this->updateWeather();
        }catch (\Exception $e){
            if(self::$attempt <= 3)
                $this->run();
            else
                Log::error('Не удалось получить актуальную погоду!!!');
        }
    }

    public function updateWeather()
    {
        $weather = $this->getWeather();

        $weatherCity = WeatherEntity::whereCityId($weather->get('id'))->first();

        if ($weatherCity == null){
            WeatherEntity::create([
                'city_id' => $weather->get('id'),
                'city' => $weather->get('name'),
                'temp' => $weather->get('main')->temp
            ]);
        }
        else{
            $weatherCity->update([
                'temp' => $weather->get('main')->temp
            ]);
        }

    }

    public function getWeather()
    {
        $weather = collect(json_decode(file_get_contents('http://api.openweathermap.org/data/2.5/weather?lang=ru&q=Kyiv&units=metric&appid=****************************')));

        return $weather;
    }
}
