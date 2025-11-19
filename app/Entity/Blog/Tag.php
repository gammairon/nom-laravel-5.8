<?php

namespace App\Entity\Blog;

use App\Entity\Seo\SeoInterface;
use App\Traits\MediaTrait;
use App\Traits\SeoTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;

/**
 * App\Entity\Blog\Tag
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Tag query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Tag whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Tag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Tag whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Tag whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Models\Media[] $media
 * @property-read \Kalnoy\Nestedset\Collection|\App\Entity\Blog\Post[] $posts
 * @property-read \App\Entity\Seo\Seo $seo
 */
class Tag extends Model implements HasMedia, SeoInterface
{
    use MediaTrait,
        SeoTrait;

    protected $guarded = [];

    public function delete()
    {
        return doTransaction(function(){

            return parent::delete();

        }, false);
    }

    public function posts()
    {
        return $this->belongsToMany('App\Entity\Blog\Post');
    }

    //Overrides Seo trait
    public function getSlugPrefix()
    {
        return 'tag/';
    }

    protected function getSeoCanonical(array $data)
    {
        $slug = Arr::get($data, 'slug') ?:$this->slug;

        return config('app.news_url').'/'.$this->getSlugPrefix().$slug;

    }
}
