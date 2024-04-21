<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{
    use HasFactory;
    use HasSlug;

    protected $fillable = [
        'title',
        'slug',
        'quantity',
        'price',
        'inStock',
        'published',
        'description',
        'user_id',
        'brand_id',
        'category_id',
        'created_by',
        'updated_id',
        'deleted_by',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function productImages(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    /*Filter logic for price , category and brand**/
    public function scopeFiltered(Builder $query)
    {
        $query->when(request('brands'), function (Builder  $q) {
            $q->whereIn('brand_id', request('brands'));
        })
            ->when(request('categories'), function (Builder  $q) {
                $q->whereIn('category_id', request('categories'));
            })

            ->when(request('prices'), function (Builder  $q) {  //user request
                $q->whereBetween('price', [ //db
                    request('prices.from' , 0),
                    request('prices.to' , 100000),
                ]);
            });
    }
}
