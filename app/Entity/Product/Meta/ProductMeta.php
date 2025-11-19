<?php

namespace App\Entity\Product\Meta;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Entity\Product\Meta
 *
 * @property int $id
 * @property int $product_id
 * @property string $product_type
 * @property string $meta_key
 * @property string|null $meta_value
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entity\Product\CreditCash[] $creditsCash
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\Meta\ProductMeta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\Meta\ProductMeta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\Meta\ProductMeta query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\Meta\ProductMeta whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\Meta\ProductMeta whereMetaKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\Meta\ProductMeta whereMetaValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\Meta\ProductMeta whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\Meta\ProductMeta whereProductType($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $product
 */
class ProductMeta extends Model
{

    protected $table = 'product_meta';

    public $timestamps = false;

    protected $guarded = [];

    public function product()
    {
        return $this->morphTo();
    }

}
