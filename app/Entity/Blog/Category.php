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
 * App\Entity\Blog\Category
 *
 * @property int $id
 * @property int $_lft
 * @property int $_rgt
 * @property int|null $parent_id
 * @property string $name
 * @property string $description
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Category whereLft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Category whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Category whereRgt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Category whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Kalnoy\Nestedset\Collection|\App\Entity\Blog\Category[] $children
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Models\Media[] $media
 * @property-read \App\Entity\Blog\Category|null $parent
 * @property-read \Kalnoy\Nestedset\Collection|\App\Entity\Blog\Post[] $posts
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Blog\Category d()
 * @property-read \App\Entity\Seo\Seo $seo
 */
class Category extends Model implements HasMedia,SeoInterface
{
    use MediaTrait,
        NodeTrait,
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
        return $this->belongsToMany('App\Entity\Blog\Post', 'post_category');
    }

    //Overrides Seo trait
    public function getSlugPrefix()
    {
        return 'categories/';
    }

    protected function getSeoCanonical(array $data)
    {
        $slug = Arr::get($data, 'slug') ?:$this->slug;

        return config('app.news_url').'/'.$this->getSlugPrefix().$slug;

    }

}
