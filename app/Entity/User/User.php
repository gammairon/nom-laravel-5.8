<?php

namespace App\Entity\User;

use App\Entity\Blog\Page;
use App\Entity\Blog\Post;
use App\Entity\Seo\SeoInterface;
use App\Traits\MediaTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Arr;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\Permission\Traits\HasRoles;
use App\Traits\SeoTrait;

/**
 * App\Entity\User\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $status
 * @property string|null $first_name
 * @property string|null $last_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Models\Media[] $media
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\User whereStatus($value)
 * @property-read \Kalnoy\Nestedset\Collection|\App\Entity\Blog\Post[] $posts
 * @property string $slug
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\User whereSlug($value)
 */
class User extends Authenticatable implements HasMedia, SeoInterface
{
    use Notifiable,
        HasRoles,
        MediaTrait,
        SeoTrait;

    const STATUS_WAIT = 'wait';
    const STATUS_ACTIVE = 'active';


    protected $fillable = [
        'name', 'email', 'password', 'status', 'first_name', 'last_name', 'slug', 'description'
    ];

    protected $dates = ['deleted_at'];

    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany('App\Entity\Blog\Post');
    }

    public function comments()
    {
        return $this->hasMany('App\Entity\Comment');
    }

    public function delete()
    {
        //Не удаляем юзера с id = 1
        if(!$this->exists || $this->id === 1)
            return false;

        return doTransaction(function (){
            //Отдать все страницы и посты юзеру с id = 1
            Post::where(['user_id' => $this->id])->update(['user_id' => 1]);
            Page::where(['user_id' => $this->id])->update(['user_id' => 1]);

            //Delete comments
            /*$this->comments->each(function ($model, $key){
                $model->delete();
            });*/

            return parent::delete();

        }, false);
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->roles()->first();
    }

    public function isWait(): bool
    {
        return $this->status === self::STATUS_WAIT;
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function verify(): void
    {
        if (!$this->isWait()) {
            throw new \DomainException('User is already verified.');
        }

        $this->update([
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /*
     * For different prefix on frontend url
     */
    public function getSlugPrefix()
    {
        return 'author/';
    }

    protected function getSeoCanonical(array $data)
    {
        $slug = Arr::get($data, 'slug') ?:$this->slug;

        return config('app.news_url').'/'.$this->getSlugPrefix().$slug;

    }

}
