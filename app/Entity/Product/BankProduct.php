<?php
/**
 * User: Gamma-iron
 * Date: 16.08.2019
 */

namespace App\Entity\Product;



use App\Traits\CommentTrait;
use App\Entity\Seo\SeoInterface;
use App\Traits\MediaTrait;
use App\Traits\ProductMetaTrait;
use App\Traits\SeoTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;

abstract class BankProduct extends Model implements HasMedia, SeoInterface
{
    use MediaTrait,
        ProductMetaTrait,
        SeoTrait,
        CommentTrait;

    protected $guarded = [];


    public function delete()
    {

        return doTransaction(function (){

            return parent::delete();

        }, false);

    }


    public function getAdvantages()
    {
        return $this->getMeta('advantage');
    }


    public function bank()
    {
        return $this->belongsTo('App\Entity\Organization\Bank');
    }

}