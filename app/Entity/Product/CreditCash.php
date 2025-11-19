<?php

namespace App\Entity\Product;


/**
 * App\Entity\Product\CreditCash
 *
 * @property int $id
 * @property int $organization_id
 * @property string $organization_type
 * @property string $name
 * @property string $slug
 * @property string|null $ref_link
 * @property float|null $rating
 * @property float|null $min_amount
 * @property float|null $max_amount
 * @property float|null $income_max_amount
 * @property int|null $min_term
 * @property int|null $max_term
 * @property float|null $percent_new_individual
 * @property float|null $percent_new_legal
 * @property float|null $percent_client
 * @property string|null $docs_individual
 * @property string|null $docs_legal
 * @property string|null $experience
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Models\Media[] $media
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entity\Product\Meta\ProductMeta[] $metas
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $organization
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCash newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCash newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCash query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCash whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCash whereDocsIndividual($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCash whereDocsLegal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCash whereExperience($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCash whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCash whereIncomeMaxAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCash whereMaxAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCash whereMaxTerm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCash whereMinAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCash whereMinTerm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCash whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCash whereOrganizationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCash whereOrganizationType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCash wherePercentClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCash wherePercentNewIndividual($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCash wherePercentNewLegal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCash whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCash whereRefLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCash whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCash whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Entity\Seo\Seo $seo
 */
class CreditCash extends BankProduct
{

    protected $table = 'credit_cash';


    //Overrides Seo trait
    public function getSlugPrefix()
    {
        return 'kredit-nalichnymi/';
    }

}
