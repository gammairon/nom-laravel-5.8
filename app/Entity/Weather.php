<?php
/**
 * User: Artem
 * Date: 26.07.2020
 */

namespace App\Entity;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Entity\Weather
 *
 * @property int $id
 * @property int $city_id
 * @property string $city
 * @property float $temp
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Weather newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Weather newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Weather query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Weather whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Weather whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Weather whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Weather whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Weather whereTemp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Weather whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Weather extends Model
{

    protected $guarded = [];

    public function getTempAttribute($value)
    {
        $temp = intval($value);

        if($temp == 0)
            return '0°С';

        return $temp < 0 ? $temp.'°С':'+'.$temp.'°С';
    }
}
