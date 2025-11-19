<?php
/**
 * User: Gamma-iron
 * Date: 19.03.2019
 */

namespace App\UseCases\XML;


use Illuminate\Support\Facades\Storage;

class XmlService
{
    protected static $ukrNetRss= [

        '_attributes' => ['version' => '2.0'],
        'channel' => [
            'title' => 'Финансы в Украине, финансовые новости | Nominal',
            'link' => 'https://nominal.com.ua/',
            'description' => 'Всё о финансах в Украине. Актуальные новости о банках. Курсы валют, кредиты, депозиты. Финансовая аналитика.',
            'item' => [
                'title' => '',
                'link' => '',
                'description' => '',
                'category' => '',
                'pubDate' => 'Thu, 18 Feb 2019 16:06:02 +0200',
                'full-text' => '',
                'enclosure' => [
                    '_attributes' => ['url' => '', 'type' => 'image/jpeg'],
                ]
            ]
        ]
    ];

    public static function toArrayFromString(string $xml): array
    {
        return XmlToArray::convert($xml);
    }

    public static function toArrayFromFile(string $filename): array
    {
        return self::toArrayFromString(Storage::get($filename));
    }


    public static function toXml(array $data, $rootElement = 'root'): string
    {
        return ArrayToXml::convert($data, $rootElement);
    }

    public static function generateUkrNetRss(): string
    {
        return self::toXml(self::$ukrNetRss, 'rss');
    }

}
