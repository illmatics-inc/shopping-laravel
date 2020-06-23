<?php

namespace App\Models;

use App\Models\Traits\FuzzySearchable;
use App\Models\Traits\Sortable;
use App\ValueObjects\ProductImage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property int $product_category_id
 * @property string $name
 * @property int $price
 * @property string|null $description
 * @property \ProductImage|void $image_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ProductCategory $productCategory
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductReview[] $productReviews
 * @property-read int|null $product_reviews_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $wishedUsers
 * @property-read int|null $wished_users_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product fuzzySearch($column, $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product sort($column, $direction)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereComparePrice($compare, $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereImagePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    use FuzzySearchable;
    use Sortable;

    const COMPARE_GTEQ = 'gteq';
    const COMPARE_LTEQ = 'lteq';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'price',
        'description',
        'product_category_id',
        'image_path',
    ];

    /**
     * @var array
     */
    private $sortables = [
        'id',
        'name',
        'price',
        'updated_at',
        'product_category',
        'review_rank',
    ];

    protected static function boot()
    {
        parent::boot();
        self::deleting(function (Product $product) {
            if (Storage::exists($product->image_path)) {
                Storage::delete($product->image_path);
            }
            $product->productReviews()->delete();
            $product->wishedUsers()->detach();
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
    public function wishedUsers()
    {
        return $this->belongsToMany(User::class, 'wish_products');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
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
        $this->attributes['image_path'] = $value->store('product_images');
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

    /**
     * @param  Builder  $query
     * @param  string|null  $compare
     * @param  int|null  $value
     * @return Builder
     */
    public function scopeWhereComparePrice(Builder $query, ?string $compare, ?int $value)
    {
        if (is_null($compare) || is_null($value) || $compare === '') {
            return $query;
        }
        switch ($compare) {
            case self::COMPARE_GTEQ:
                $builder = $query->where('price', '>=', $value);
                break;
            case self::COMPARE_LTEQ:
                $builder = $query->where('price', '<=', $value);
                break;
            default:
                $builder = $query;
        }
        return $builder;
    }

    /**
     * @param  Builder  $query
     * @param  string  $column
     * @param  string  $direction
     * @return Builder|\Illuminate\Database\Query\Builder
     */
    protected function buildSortQuery(Builder $query, string $column, string $direction)
    {
        switch ($column) {
            case 'product_category':
                return $query
                    ->join('product_categories', 'product_categories.id', '=', 'products.product_category_id')
                    ->select('products.*')
                    ->orderBy('product_categories.order_no', $direction)
                    ->orderBy('products.id', 'asc');
            case 'review_rank':
                return $query
                    ->leftJoin('product_reviews', 'product_reviews.product_id', '=', 'products.id')
                    ->groupBy('products.id')
                    ->select('products.*')
                    ->orderByRaw('avg(`product_reviews`.`rank`) desc')
                    ->orderBy('products.id', 'asc');
        }
        return $query->orderBy($column, $direction);
    }
}
