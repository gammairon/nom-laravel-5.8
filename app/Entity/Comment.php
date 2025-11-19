<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

/**
 * App\Entity\CommentController
 *
 * @property int $id
 * @property int $_lft
 * @property int $_rgt
 * @property int|null $parent_id
 * @property int|null $user_id
 * @property int $commentable_id
 * @property string $commentable_type
 * @property string|null $email
 * @property string|null $name
 * @property string|null $message
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Kalnoy\Nestedset\Collection|\App\Entity\Comment[] $children
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $commentable
 * @property-read \App\Entity\Comment|null $parent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Comment d()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Comment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Comment whereCommentableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Comment whereCommentableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Comment whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Comment whereLft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Comment whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Comment whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Comment whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Comment whereRgt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Comment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Comment whereUserId($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Comment panding()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Comment public()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Comment spam()
 */
class Comment extends Model
{
    use NodeTrait;

    const PANDING_STATUS = 'panding';

    const PUBLIC_STATUS = 'public';

    const SPAM_STATUS = 'spam';


    protected $guarded = ['status'];

    /**
     * Scope a query to only include panding comments.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePanding($query)
    {
        return $query->where('status', self::PANDING_STATUS);
    }

    /**
     * Scope a query to only include public comments.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublic($query)
    {
        return $query->where('status', self::PUBLIC_STATUS);
    }


    /**
     * Scope a query to only include spam comments.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSpam($query)
    {
        return $query->where('status', self::SPAM_STATUS);
    }

    /**
     * Get all of the owning commentable models.
     */
    public function commentable()
    {
        return $this->morphTo();
    }


    /**
     * @param int $words
     * @return string
     */
    public function getShortMessage(int $words = 55): string
    {
        return mb_substr($this->message, 0, $words);
    }

    public function setStatus(string $value)
    {
        if(!key_exists($value, $this->getStatuses()))
            throw new \InvalidArgumentException("Comment status: $value do not exist!");

        $this->status = $value;
    }

    public function getStatuses(): array
    {
        return [
            self::PANDING_STATUS => 'В ожидании',
            self::PUBLIC_STATUS => 'Опубликовать',
            self::SPAM_STATUS => 'Спам'
        ];
    }
}
