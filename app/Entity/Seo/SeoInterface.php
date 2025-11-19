<?php
/**
 * User: Gamma-iron
 * Date: 22.05.2019
 */

namespace App\Entity\Seo;


use App\Entity\Seo\Seo;
use Illuminate\Support\Collection;

interface SeoInterface
{

    public function seo();

    public function seoMetas(): Collection;

    public function seoMeta(string $key): ?string;

}