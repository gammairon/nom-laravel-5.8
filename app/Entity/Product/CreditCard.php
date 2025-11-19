<?php

namespace App\Entity\Product;


/**
 * App\Entity\Product\CreditCard
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Models\Media[] $media
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entity\Product\Meta\ProductMeta[] $metas
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $organization
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCard newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCard newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCard query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCard whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCard whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCard whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $organization_id
 * @property string $organization_type
 * @property string $name
 * @property string $slug
 * @property string|null $ref_link
 * @property float|null $rating
 * @property float|null $max_limit
 * @property float|null $income_max_limit
 * @property int|null $grace_period
 * @property float|null $rate_in
 * @property float|null $rate_after
 * @property string|null $service
 * @property float|null $cash_back
 * @property float|null $loan
 * @property int $chip
 * @property int $pay_wave
 * @property int $visa
 * @property int $master_card
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCard whereCashBack($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCard whereChip($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCard whereGracePeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCard whereIncomeMaxLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCard whereLoan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCard whereMasterCard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCard whereMaxLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCard whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCard whereOrganizationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCard whereOrganizationType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCard wherePayWave($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCard whereRateAfter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCard whereRateIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCard whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCard whereRefLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCard whereService($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCard whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCard whereVisa($value)
 * @property-read \App\Entity\Seo\Seo $seo
 * @property string|null $preview
 * @property int|null $min_age
 * @property int|null $max_age
 * @property string|null $currency
 * @property string|null $list_documents
 * @property string|null $terms_repayment
 * @property string|null $fines_penalties
 * @property string|null $insurance
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCard wherePreview($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCard whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCard whereFinesPenalties($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCard whereInsurance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCard whereListDocuments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCard whereMaxAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCard whereMinAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Product\CreditCard whereTermsRepayment($value)
 */
class CreditCard extends BankProduct
{

    //Overrides Seo trait
    public function getSlugPrefix()
    {
        return 'kreditnye-karty/';
    }

}
