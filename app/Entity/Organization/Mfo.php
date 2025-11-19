<?php

namespace App\Entity\Organization;

use App\Entity\Seo\SeoInterface;
use App\Filters\Mfo\MfoFilter;
use App\Filters\Mfo\MfoSorteble;
use App\Traits\CommentTrait;
use App\Traits\MediaTrait;
use App\Traits\SeoTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\HasMedia\HasMedia;

/**
 * App\Entity\Organization\Mfo
 *
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property string|null $ref_link
 * @property float|null $rating
 * @property float|null $first_credit
 * @property string|null $free_credit_description
 * @property float|null $free_credit_bid
 * @property float|null $free_credit_amount
 * @property float|null $min_amount
 * @property float|null $max_amount
 * @property float|null $repeat_credit_bid
 * @property int|null $min_term
 * @property int|null $max_term
 * @property int|null $min_age
 * @property int|null $max_age
 * @property int|null $time_review
 * @property int $receiving_method_card
 * @property int $receiving_method_cash
 * @property string|null $special_offer
 * @property string|null $web_site
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $address
 * @property string|null $work_time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Models\Media[] $media
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Mfo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Mfo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Mfo query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Mfo whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Mfo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Mfo whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Mfo whereFirstCredit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Mfo whereFreeCreditAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Mfo whereFreeCreditBid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Mfo whereFreeCreditDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Mfo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Mfo whereMaxAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Mfo whereMaxAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Mfo whereMaxTerm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Mfo whereMinAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Mfo whereMinAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Mfo whereMinTerm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Mfo whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Mfo wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Mfo whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Mfo whereReceivingMethodCard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Mfo whereReceivingMethodCash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Mfo whereRefLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Mfo whereRepeatCreditBid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Mfo whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Mfo whereSpecialOffer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Mfo whereTimeReview($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Mfo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Mfo whereWebSite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Mfo whereWorkTime($value)
 * @mixin \Eloquent
 * @property string|null $preview
 * @property-read \App\Entity\Seo\Seo $seo
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Mfo wherePreview($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Mfo filter($inputs)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Mfo sort($orderKey)
 * @property string|null $nfs_license
 * @property-read \Kalnoy\Nestedset\Collection|\App\Entity\Comment[] $comments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entity\Lists\ListMfo[] $lists
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Organization\Mfo whereNfsLicense($value)
 */
class Mfo extends Model implements HasMedia, SeoInterface
{

    use MediaTrait,
        SeoTrait,
        CommentTrait;

    protected $table = 'mfo_org';

    protected $guarded = [];

    protected $appends = ['edit_link'];


    public function delete()
    {

        return doTransaction(function(){

            return parent::delete();

        }, false);

    }

    public function getEditLinkAttribute()
    {
        return route('admin.organizations.mfo.edit', $this);
    }

    //Scopes=====================================
    public function scopeFilter(Builder $builder, array $inputs)
    {
        return (new MfoFilter(collect($inputs)))->filter($builder);
    }


    public function scopeSort(Builder $builder, $orderKey)
    {
        return (new MfoSorteble($orderKey))->sort($builder);
    }

    //Relationship======================
    public function lists()
    {
        return $this->belongsToMany('App\Entity\Lists\ListMfo', 'list_mfo','mfo_id', 'list_id')->withPivot('sort');
    }

    //Overrides Seo trait
    public function getSlugPrefix()
    {
        return 'kredit-online/';
    }
}
