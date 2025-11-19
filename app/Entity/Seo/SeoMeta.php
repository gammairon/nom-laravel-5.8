<?php

namespace App\Entity\Seo;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Entity\Seo\SeoMeta
 *
 * @property int $id
 * @property int $seo_id
 * @property string $meta_key
 * @property string|null $meta_value
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $seo
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Seo\SeoMeta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Seo\SeoMeta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Seo\SeoMeta query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Seo\SeoMeta whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Seo\SeoMeta whereMetaKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Seo\SeoMeta whereMetaValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Seo\SeoMeta whereSeoId($value)
 * @mixin \Eloquent
 */
class SeoMeta extends Model
{
    protected $table = 'seo_meta';

    public $timestamps = false;

    protected $guarded = [];

    public function seo()
    {
        return $this->belongsTo('App\Entity\Seo\Seo');
    }

}
