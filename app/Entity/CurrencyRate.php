<?php
/**
 * User: Artem
 * Date: 26.07.2020
 */

namespace App\Entity;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Entity\CurrencyRate
 *
 * @property int $id
 * @property string $txt
 * @property string $cc
 * @property string $exchangedate
 * @property float $old_rate
 * @property float $new_rate
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\CurrencyRate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\CurrencyRate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\CurrencyRate query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\CurrencyRate whereCc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\CurrencyRate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\CurrencyRate whereExchangedate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\CurrencyRate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\CurrencyRate whereNewRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\CurrencyRate whereOldRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\CurrencyRate whereTxt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\CurrencyRate whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $api
 * @property int $ordered
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\CurrencyRate whereApi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\CurrencyRate whereOrdered($value)
 * @property float $old_rate_buy
 * @property float $old_rate_sale
 * @property float $new_rate_buy
 * @property float $new_rate_sale
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\CurrencyRate whereNewRateBuy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\CurrencyRate whereNewRateSale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\CurrencyRate whereOldRateBuy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\CurrencyRate whereOldRateSale($value)
 */
class CurrencyRate extends Model
{
    public static $currencyNbuCodes = ['USD', 'EUR', 'RUB'];
    public static $currencyPrivatBankCodes = ['USD', 'EUR', 'RUR'];

    protected $guarded = [];


    protected static function boot() {
        parent::boot();
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('ordered');
        });
    }
}
