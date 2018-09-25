<?php

namespace App\Eloquent;

use App\{
    Events, Eloquent\Traits, Contracts
};

use Illuminate\Database\Eloquent\{ 
    Model, Builder, Relations\BelongsToMany 
};
/**
 * Base products model. Related to Offers and Categories models.
 */
class Products extends Model
{
    use Traits\ProvidingFillable;

    protected $fillable = [
        'id', 
        'title', 
        'image', 
        'description', 
        'first_invoice', 
        'url', 
        'price', 
        'amount'
    ];

    protected $dispatchesEvents = [
        'saving' => Events\ModelSaving::class,
    ];

    /**
     * Scope a query to only include popular products.
     * 
     * Popular in this case means products with most count of sales.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePopular(Builder $query): Builder
    {
        return $query
            ->addSelect('products.*', \DB::raw('SUM(sales) as sum'))
            ->join('products_offers', 'products_offers.product_id', '=', 'products.id')
            ->join('offers', 'offers.id', '=', 'products_offers.offer_id')
            ->groupBy('products.id')
            ->orderBy('sum', 'DESC');
    }

    /**
     * Bind products to its categories.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories(): BelongsToMany 
    {
        return $this->belongsToMany(
            Category::class, 
            'products_categories', 
            'product_id', 
            'category_id'
        );
    }

    /**
     * Bind products to its offers.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function offers(): BelongsToMany 
    {
        return $this->belongsToMany(
            Offer::class, 
            'products_offers', 
            'product_id', 
            'offer_id'
        );
    }
}
