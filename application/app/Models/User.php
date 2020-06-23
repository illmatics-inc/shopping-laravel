<?php

namespace App\Models;

use App\Models\Traits\ForwardMatchable;
use App\Models\Traits\FuzzySearchable;
use App\Models\Traits\Sortable;
use App\ValueObjects\UserImage;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \UserImage|void $image_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductReview[] $productReviews
 * @property-read int|null $product_reviews_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $wishProducts
 * @property-read int|null $wish_products_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User forwardMatch($column, $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User fuzzySearch($column, $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User sort($column, $direction)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereImagePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;
    use FuzzySearchable;
    use ForwardMatchable;
    use Sortable;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image_path',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @var array
     */
    private $sortables = [
        'id',
        'name',
        'email',
    ];

    protected static function boot()
    {
        parent::boot();
        self::deleting(function (User $user) {
            if (Storage::exists($user->image_path)) {
                Storage::delete($user->image_path);
            }
            $user->productReviews()->delete();
            $user->wishProducts()->detach();
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productReviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function wishProducts()
    {
        return $this->belongsToMany(Product::class, 'wish_products');
    }

    /**
     * @param  string|null  $value
     */
    public function setPasswordAttribute(?string $value)
    {
        if (!isset($value)) {
            return;
        }
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * @param UploadedFile|null $value
     */
    public function setImagePathAttribute(?UploadedFile $value)
    {
        if (isset($this->image_path) && Storage::exists($this->image_path)) {
            Storage::delete($this->image_path);
        }
        if (is_null($value)) {
            $this->attributes['image_path'] = null;
            return;
        }
        $this->attributes['image_path'] = $value->store('user_images');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\UrlGenerator|string|null
     */
    public function getImage()
    {
        if (blank($this->image_path)) {
            return null;
        }
        return url(Storage::url($this->image_path));
    }
}
