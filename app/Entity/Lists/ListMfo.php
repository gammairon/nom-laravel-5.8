<?php
/**
 * User: Gamma-iron
 * Date: 16.01.2020
 */

namespace App\Entity\Lists;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Entity\Lists\ListMfo
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entity\Organization\Mfo[] $mfos
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Lists\ListMfo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Lists\ListMfo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Lists\ListMfo query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Lists\ListMfo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Lists\ListMfo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Lists\ListMfo whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Lists\ListMfo whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ListMfo extends Model
{
    protected $table = 'lists';

    protected $guarded = [];

    public function getShortcode(): string
    {
        return '[mfo_list_group list_id='.$this->id.']';
    }


    public function delete()
    {
        return doTransaction(function(){

            return parent::delete();

        }, false);
    }

    public function mfos()
    {
        return $this->belongsToMany('App\Entity\Organization\Mfo', 'list_mfo','list_id', 'mfo_id')->withPivot('sort');
    }
}
