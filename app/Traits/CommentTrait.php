<?php
/**
 * User: Gamma-iron
 * Date: 05.10.2019
 */

namespace App\Traits;


use Illuminate\Database\Eloquent\SoftDeletes;

trait CommentTrait
{

    public static function bootCommentTrait()
    {
        static::deleting(function ($entity) {

            if (in_array(SoftDeletes::class, class_uses_recursive($entity))) {
                if (! $entity->forceDeleting) {
                    return;
                }
            }

            $entity->comments()->get()->each->delete();
        });
    }

    public function comments()
    {
        return $this->morphMany('App\Entity\Comment', 'commentable');
    }

}