<?php

namespace App\Entity\Blog;

use App\Entity\Seo\SeoInterface;
use App\Helpers\Transliterate;
use App\Traits\FaqableTrait;
use App\Traits\MediaTrait;
use App\Traits\SeoTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;

/**
 * App\Entity\Blog\Post
 *
 * @property int $id
 * @property int $user_id
 * @property int $_lft
 * @property int $_rgt
 * @property int|null $parent_id
 * @property string $name
 * @property string $content
 * @property string $excerpt
 * @property string $slug
 * @property string $status
 * @property string|null $public_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Post whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Post whereExcerpt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Post whereLft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Post whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Post whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Post wherePublicDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Post whereRgt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Post whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Post whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Post whereUserId($value)
 * @mixin \Eloquent
 * @property-read \Kalnoy\Nestedset\Collection|\App\Entity\Blog\Category[] $categories
 * @property-read \Kalnoy\Nestedset\Collection|\App\Entity\Blog\Post[] $children
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Models\Media[] $media
 * @property-read \App\Entity\Blog\Post|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entity\Blog\Tag[] $tags
 * @property-read \App\Entity\User\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Post d()
 * @property int $top
 * @property int $views
 * @property-read \App\Entity\Seo\Seo $seo
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Post whereTop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Post whereViews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Post ordered($field = 'public_date', $direction = 'DESC')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Post public()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Post wait()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Post defaultOrdered()
 */
class Post extends Model implements HasMedia, SeoInterface
{
    use MediaTrait,
        NodeTrait,
        FaqableTrait,
        SeoTrait;

    const STATUS_DRAFT = 'draft';
    const STATUS_WAIT = 'wait';
    const STATUS_PUBLIC = 'public';

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

    public function popularPostsByTag($limit = 3): Collection
    {
        return Cache::tags(['posts'])->remember('tag:popular:posts:'.$this->id, 21600, function () use($limit) {
            return $this->tags->isNotEmpty() ? $this->tags->first()->posts()->public()->with('media')->where('id', '<>', $this->id)->orderByDesc('public_date')->limit($limit)->get() : collect([]);
        });

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

    public function setPublicDateAttribute( $value ) {
        $date = Carbon::createFromFormat('d/m/Y', $value);

        if($this->exists){
            if($this->public_date->diffInDays($date) != 0)
                $this->attributes['public_date'] =  $date->toDateTimeString();
        } else {
            $this->attributes['public_date'] = $date->toDateTimeString();
        }
    }

    public function setSlugAttribute($slug)
    {
        if(is_null($slug)){
            $slug = Transliterate::convertSlug($this->name);

            $validator = Validator::make(['slug' => $slug], [
                'slug' => 'string|max:191|alpha_dash|unique:pages,slug|unique:posts,slug,'.$this->id
            ]);

            //Если не уникальна лепим дату и время
            if($validator->fails()){
                $slug .= Carbon::now()->format('-d-m-Y-H-i');;
            }

        }

        $this->attributes['slug'] = $slug;
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

    public function scopeDefaultOrdered($query)
    {
       return $query->orderBy('public_date', 'DESC');
    }


    //Relationship======================
    public function user()
    {
        return $this->belongsTo('App\Entity\User\User');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Entity\Blog\Category', 'post_category');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Entity\Blog\Tag');
    }

    //Overrides Seo trait
    protected function getSeoCanonical(array $data)
    {
        $slug = Arr::get($data, 'slug') ?:$this->slug;

        return config('app.news_url').'/'.$this->getSlugPrefix().$slug;

    }

}
