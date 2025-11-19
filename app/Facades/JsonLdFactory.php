<?php
/**
 * User: Gamma-iron
 * Date: 01.07.2019
 */

namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class JsonLdFactory extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'JsonLdFactory';
    }

}