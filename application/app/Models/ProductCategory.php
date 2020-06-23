<?php

namespace App\Models;

use App\Models\Traits\FuzzySearchable;
use App\Models\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductCategory
 *
 * @property int $id
 * @property string $name
 * @property int $order_no
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategory fuzzySearch($column, $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategory sort($column, $direction)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategory whereOrderNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductCategory extends Model
{
    use FuzzySearchable;
    use Sortable;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'order_no',
    ];

    /**
     * @var array
     */
    private $sortables = [
        'id',
        'name',
        'order_no',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
