<?php

namespace App\Eloquent;

use App\{
    Events, Eloquent\Traits, Eloquent\Products
};

use Illuminate\Database\Eloquent\{ Model, Relations\BelongsToMany };

/**
 * Categories model. Represent product's category.
 */
class Category extends Model
{
    use Traits\ProvidingFillable;

    protected $fillable = [
        'id', 
        'title', 
        'alias', 
        'parent'
    ];

    protected $dispatchesEvents = [
        'saving' => Events\ModelSaving::class,
    ];

    /**
     * Bind categories to its products.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products(): BelongsToMany 
    {
        return $this->belongsToMany(
            Products::class, 
            'products_categories', 
            'category_id', 
            'product_id'
        );
    }
}
