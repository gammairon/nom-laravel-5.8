<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

/**
 * App\Entity\Setting
 *
 * @property int $id
 * @property string $name
 * @property string|null $val
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Setting whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Setting whereVal($value)
 * @mixin \Eloquent
 */
class Setting extends Model
{
    protected $guarded = [];

    protected static $settings = [];


    public static function getSiteName(): string
    {
        if(!isset(self::$settings['site_name'])){
            $siteName = Cache::tags(['settings'])->rememberForever('site:name', function (){
                return Setting::whereName('site_name')->value('val');
            });

            self::$settings['site_name'] = $siteName;
        }


        return self::$settings['site_name'];
    }

    public static function getSiteDescription(): string
    {
        if(!isset(self::$settings['site_description'])){
            $siteDescription = Cache::tags(['settings'])->rememberForever('site:description', function (){
                return Setting::whereName('site_description')->value('val');
            });

            self::$settings['site_description'] = $siteDescription;
        }


        return self::$settings['site_description'];
    }

}
