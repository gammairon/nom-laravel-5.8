<?php

namespace App\Entity\Blog;

use App\Entity\Seo\SeoInterface;
use App\Traits\FaqableTrait;
use App\Traits\MediaTrait;
use App\Traits\SeoTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;

/**
 * App\Entity\Blog\Page
 *
 * @property int $id
 * @property int $user_id
 * @property int $_lft
 * @property int $_rgt
 * @property int|null $parent_id
 * @property string $name
 * @property string $content
 * @property string $slug
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $public_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Kalnoy\Nestedset\Collection|\App\Entity\Blog\Page[] $children
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Models\Media[] $media
 * @property-read \App\Entity\Blog\Page|null $parent
 * @property-read \App\Entity\User\User $user
 * @method \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Page d()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Page newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Page query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Page whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Page whereLft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Page whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Page whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Page wherePublicDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Page whereRgt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Page whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Page whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Page whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Page whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Page public()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Page wait()
 * @mixin \Eloquent
 * @property int $views
 * @property-read \App\Entity\Seo\Seo $seo
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Page whereViews($value)
 */
class Page extends Model implements HasMedia,SeoInterface
{
    use MediaTrait,
        NodeTrait,
        FaqableTrait,
        SeoTrait;

    const STATUS_PUBLIC = 'public';
    const STATUS_DRAFT = 'draft';
    const STATUS_WAIT = 'wait';


    protected $guarded = ['id', 'views'];

    protected $dates = ['public_date'];



    public function delete()
    {

        return doTransaction(function(){

            return parent::delete();

        }, false);

    }


    public static function getStatuses()
    {
        return [
            self::STATUS_PUBLIC => 'Опубликован',
            self::STATUS_DRAFT => 'В корзине',
            self::STATUS_WAIT => 'В ожидании',
        ];
    }


    /**
     * @param null $status
     * @return mixed
     */
    public function getStatusTitle($status = null)
    {
        if(!is_null($status))
            return Arr::get(self::getStatuses(), $status);

        if(!is_null($this->status))
            return Arr::get(self::getStatuses(), $this->status);

        throw new \InvalidArgumentException('Status Page do not exist');
    }



    //Scope===================================

    public function scopePublic($query)
    {
        return $query->where('status', '=', self::STATUS_PUBLIC);
    }

    public function scopeWait($query)
    {
        return $query->where('status', '=', self::STATUS_WAIT);
    }


    //Relationship======================
    public function user()
    {
        return $this->belongsTo('App\Entity\User\User');
    }

    //Mutators======================
    public function setPublicDateAttribute($value)
    {
        $this->attributes['public_date'] = Carbon::createFromFormat('d/m/Y', $value);
    }

}
