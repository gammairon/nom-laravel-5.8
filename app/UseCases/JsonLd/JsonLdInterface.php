<?php
/**
 * User: Gamma-iron
 * Date: 01.07.2019
 */

namespace App\UseCases\JsonLd;


interface JsonLdInterface
{

    public function toJson(): ?string;

    public function generate(): ?string;

}