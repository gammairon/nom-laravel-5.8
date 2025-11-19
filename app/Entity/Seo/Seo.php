<?php

namespace App\Entity\Seo;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Entity\Seo\Seo
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Seo\Seo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Seo\Seo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Seo\Seo query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $seoeable_id
 * @property string $seoeable_type
 * @property string|null $title
 * @property string|null $description
 * @property string|null $keywords
 * @property string|null $canonical
 * @property string|null $robot_index
 * @property string|null $robot_follow
 * @property string|null $amp_html
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entity\Seo\SeoMeta[] $metas
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $seoeable
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Seo\Seo whereAmpHtml($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Seo\Seo whereCanonical($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Seo\Seo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Seo\Seo whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Seo\Seo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Seo\Seo whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Seo\Seo whereRobotFollow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Seo\Seo whereRobotIndex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Seo\Seo whereSeoeableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Seo\Seo whereSeoeableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Seo\Seo whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Seo\Seo whereUpdatedAt($value)
 */
class Seo extends Model
{

    const FRONT_SEO = 'front';
    const NEWS_SEO = 'news';
    const CATEGORIES_SEO = 'categories';
    const TAGS_SEO = 'tags';
    const AUTHOR_ARCHIVE_SEO = 'author_archive';
    const CREDIT_CARDS_ARCHIVE_SEO = 'credit_cards_archive';
    const CREDIT_CASH_ARCHIVE_SEO = 'credit_cash_archive';
    const MFO_SEO = 'mfo';
    const BANKS_SEO = 'banks';
    const SEARCH_SEO = 'search';

    protected $guarded = [];

    public function seoeable()
    {
        return $this->morphTo();
    }

    public function metas()
    {
        return $this->hasMany('App\Entity\Seo\SeoMeta');
    }

    public function getRobots(): string
    {
        return $this->robot_index.','.$this->robot_follow;
    }
}
