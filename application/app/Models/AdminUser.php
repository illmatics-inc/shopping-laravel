<?php

namespace App\Models;

use App\Models\Traits\ForwardMatchable;
use App\Models\Traits\FuzzySearchable;
use App\Models\Traits\Sortable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

/**
 * App\Models\AdminUser
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property bool $is_owner
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminUser forwardMatch($column, $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminUser fuzzySearch($column, $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminUser sort($column, $direction)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminUser whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminUser whereIsOwner($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminUser whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminUser wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminUser whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AdminUser extends Authenticatable
{
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
        'is_owner',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'is_owner' => 'boolean',
    ];

    /**
     * @var array
     */
    private $sortables = [
        'id',
        'name',
        'email',
    ];

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
}
