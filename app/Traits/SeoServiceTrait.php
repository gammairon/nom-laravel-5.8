<?php
/**
 * User: Gamma-iron
 * Date: 06.06.2019
 */

namespace App\Traits;


use App\Entity\Blog\Post;
use App\Entity\Seo\Seo;
use App\Entity\Setting;
use App\Facades\JsonLdFactory;
use App\UseCases\JsonLd\JsonLdInterface;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;


trait SeoServiceTrait
{

    /**
     * @param Seo $seo
     * @param null|Illuminate\Database\Eloquent\Model $model
     */
    public function setSeo(Seo $seo, $model = null)
    {
        //For AMP pages
        if (!is_null($model) && get_class($model) == Post::class){
            /**
             * @var Post $model
             */
            SEOMeta::setAmpHtml(route('amp.page', ['slug' => $model->slug]));
        }


        //SEOMeta::addMeta($meta, $value = null, $name = 'name');
        //SEOMeta::addAlternateLanguage($lang, $url);
        //SEOMeta::addAlternateLanguages(array $languages);
        SEOMeta::setTitleSeparator(' | ');
        //$this->setTitleDefault();
        SEOMeta::setTitle($this->replaceRegex($seo->title));

        SEOMeta::setDescription($this->replaceRegex($seo->description));
        //SEOMeta::addKeyword($keyword);
        SEOMeta::setKeywords($this->replaceRegex($seo->keywords));
        SEOMeta::setRobots($seo->getRobots());
        SEOMeta::setCanonical($seo->canonical);
        //SEOMeta::setPrev($url);
        //SEOMeta::setNext($url);
        //SEOMeta::removeMeta($key);

        $this->setOpenGraph($seo, $model);
        $this->setTwitter($seo, $model);
    }

    public function setTitleDefault()
    {
        $title = Setting::getSiteName();
        SEOMeta::setTitleDefault($title);
    }


    public function setOpenGraph(Seo $seo, $model = null)
    {
        if(!is_null($model) && $model->hasPrimary()){
            OpenGraph::addImage(asset($model->getPrimaryUrl()));
        }
        else{
            OpenGraph::addImage(null);
        }
        //OpenGraph::addProperty($key, $value); // value can be string or array
        //OpenGraph::addImage($url); // add image url
        //OpenGraph::addImages($url); // add an array of url images
        OpenGraph::setTitle($this->replaceRegex($seo->title)); // define title
        OpenGraph::setDescription($this->replaceRegex($seo->description));  // define description
        OpenGraph::setUrl($seo->canonical); // define url
        OpenGraph::setSiteName(Setting::getSiteName()); //define site_name
    }

    public function setTwitter(Seo $seo, $model = null)
    {
        /*TwitterCard::addValue($key, $value); // value can be string or array
        TwitterCard::setType($type); // type of twitter card tag
        TwitterCard::setTitle($type); // title of twitter card tag
        TwitterCard::setSite($type); // site of twitter card tag
        TwitterCard::setDescription($type); // description of twitter card tag
        TwitterCard::setUrl($type); // url of twitter card tag
        TwitterCard::setImage($url); // add image url*/
        TwitterCard::setTitle($this->replaceRegex($seo->title)); // title of twitter card tag
        TwitterCard::setSite(Setting::getSiteName()); // site of twitter card tag
        TwitterCard::setDescription($this->replaceRegex($seo->description)); // description of twitter card tag
        TwitterCard::setUrl($seo->canonical); // url of twitter card tag

        if(!is_null($model) && $model->hasPrimary()){
            TwitterCard::setImage(asset($model->getPrimaryUrl()));
        }
    }


    public function setJsonLd(JsonLdInterface $jsonLd)
    {
        JsonLdFactory::add($jsonLd);
    }


    //Заменяем все регулярки строками
    protected function replaceRegex(?string $value): string
    {
        return str_replace(['%%sitename%%', '%%sitedesc%%'], [Setting::getSiteName(), Setting::getSiteDescription()], $value);
    }

}
