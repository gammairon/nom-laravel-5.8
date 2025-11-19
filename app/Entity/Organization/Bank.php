<?php

namespace App\Entity\Organization;

use App\Entity\Seo\SeoInterface;
use App\Traits\MediaTrait;
use App\Traits\SeoTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;

/**
 * App\Entity\Organization\Bank
 *
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property string|null $president_name
 * @property float|null $rating
 * @property string|null $mfo
 * @property string|null $swift
 * @property string|null $egrdpou
 * @property string|null $number_reg
 * @property \Illuminate\Support\Carbon|null $date_reg
 * @property string|null $number_license
 * @property \Illuminate\Support\Carbon|null $date_license
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entity\Product\CreditCash[] $creditsCash
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Models\Media[] $media
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Bank newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Bank newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Bank query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Bank whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Bank whereDateLicense($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Bank whereDateReg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Bank whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Bank whereEgrdpou($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Bank whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Bank whereMfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Bank whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Bank whereNumberLicense($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Bank whereNumberReg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Bank wherePresidentName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Bank whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Bank whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Bank whereSwift($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Bank whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Entity\Seo\Seo $seo
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entity\Product\CreditCard[] $creditsCard
 * @property string|null $head_office
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $web_site
 * @property string|null $preview
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Bank whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Bank whereHeadOffice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Bank wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Bank wherePreview($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Bank whereWebSite($value)
 * @property-read \Kalnoy\Nestedset\Collection|\App\Entity\Comment[] $comments
 */
class Bank extends Model implements HasMedia, SeoInterface
{
    use MediaTrait,
        SeoTrait;

    const PRESIDENT_PHOTO = "president_photo";

    protected $guarded = [];

    protected $dates = ['date_reg', 'date_license'];


    public function delete()
    {

        return doTransaction(function (){

            //Delete Products
            $this->creditsCash->each(function ($model, $key){
                /** @var \Illuminate\Database\Eloquent\Model $model */
                $model->delete();
            });

            $this->creditsCard->each(function ($model, $key){
                /** @var \Illuminate\Database\Eloquent\Model $model */
                $model->delete();
            });

            return parent::delete();
        });
    }


    public function creditsCash()
    {
        return $this->morphMany('App\Entity\Product\CreditCash', 'organization');
    }

    public function creditsCard()
    {
        return $this->morphMany('App\Entity\Product\CreditCard', 'organization');
    }
    
    public function comments()
    {
        return $this->morphMany('App\Entity\Comment', 'commentable');
    }

    public function registerMediaCollections()
    {
        $this->addMediaCollection($this->getPrimaryCollName())->singleFile();

        $this->addMediaCollection(self::PRESIDENT_PHOTO)->singleFile();

        $this->addMediaCollection($this->getMediaCollName());
    }

    public function  setDateRegAttribute($value)
    {
        $this->attributes['date_reg'] = Carbon::createFromFormat('d/m/Y', $value);
    }

    public function  setDateLicenseAttribute($value)
    {
        $this->attributes['date_license'] = Carbon::createFromFormat('d/m/Y', $value);
    }

    //Overrides Seo trait
    public function getSlugPrefix()
    {
        return 'banks/';
    }
}
