<?php
/**
 * User: Artem
 * Date: 29.07.2021
 */

namespace App\Entity;


use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = 'faqs';

    protected $guarded = [];

    public $timestamps = false;


    public function faqable()
    {
        return $this->morphTo();
    }
}
