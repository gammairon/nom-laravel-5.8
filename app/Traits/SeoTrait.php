<?php
/**
 * User: Gamma-iron
 * Date: 22.05.2019
 */

namespace App\Traits;


use App\Entity\Seo\SeoInterface;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use App\Entity\Seo\Seo;


trait SeoTrait
{

    public static function bootSeoTrait()
    {
        static::deleting(function (SeoInterface $entity) {

            if (in_array(SoftDeletes::class, class_uses_recursive($entity))) {
                if (! $entity->forceDeleting) {
                    return;
                }
            }

            $entity->seo()->get()->each->delete();
        });
    }

    public function seo()
    {
        return $this->morphOne('App\Entity\Seo\Seo', 'seoeable');
    }


    public function seoMetas(): Collection
    {
        return $this->seo->metas()->get();
    }

    public function seoMeta(string $key): ?string
    {
        return $this->seoMetas()->pluck($key);
    }

    public function updateSeo(array $data): ?Seo
    {
        if(!$this->exists)
            return null;

        $seoData = [
            'seoeable_id' => $this->id,
            'seoeable_type' => static::class,
            'title' => $this->getSeoTitle($data),
            'description' =>  $this->getSeoDescription($data),
            'keywords' => Arr::get($data, 'seo.keywords'),
            'canonical' => $this->getSeoCanonical($data),
            'robot_index' => Arr::get($data, 'seo.robot_index', 'INDEX'),
            'robot_follow' => Arr::get($data, 'seo.robot_follow', 'FOLLOW'),
            'amp_html' => null,
        ];


        if(is_null($this->seo))
            return Seo::create($seoData);

        if(!$this->seo->fill($seoData)->save())
            throw new \DomainException('Сохранить SEO не удалось');

        return $this->seo;

        /*
         * For meta data functionality
        $seoMetaData = Arr::get($seoData, 'meta', []);

        if(is_null($this->seo))
            return $this->seo()->save(SeoModel::create(Arr::except($seoData, 'meta')));


        return $this->seo->fill($data)->save();*/
    }

    protected function getSeoTitle(array $data)
    {
        return is_null(Arr::get($data, 'seo.title')) ? Arr::get($data, 'name') : Arr::get($data, 'seo.title');
    }

    protected function getSeoDescription(array $data)
    {
        return is_null(Arr::get($data, 'seo.description')) ? Arr::get($data, 'excerpt') : Arr::get($data, 'seo.description');
    }

    protected function getSeoCanonical(array $data)
    {
        $slug = Arr::get($data, 'slug') ?:$this->slug;

        $canonical = url($this->getSlugPrefix().$slug);

        return $canonical;
    }

    /*
     * For different prefix on frontend url
     */
    public function getSlugPrefix()
    {
        return null;
    }


}