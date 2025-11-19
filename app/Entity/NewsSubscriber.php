<?php
/**
 * User: Artem
 * Date: 27.07.2020
 */

namespace App\Entity;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Entity\NewsSubscriber
 *
 * @property int $id
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\NewsSubscriber newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\NewsSubscriber newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\NewsSubscriber query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\NewsSubscriber whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\NewsSubscriber whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\NewsSubscriber whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\NewsSubscriber whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class NewsSubscriber extends Model
{

    protected $guarded = [];

    protected $table = 'news_subscribers';


}
