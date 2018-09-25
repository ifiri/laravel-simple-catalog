<?php

namespace App\Eloquent;

use App\{
    Events, Eloquent\Traits
};

use Illuminate\Database\Eloquent\Model;

/**
 * Offer model. Represent separate product's offer.
 */
class Offer extends Model
{
    use Traits\ProvidingFillable;

    protected $fillable = [
        'id', 
        'price', 
        'amount', 
        'sales', 
        'article'
    ];

    protected $dispatchesEvents = [
        'saving' => Events\ModelSaving::class,
    ];
}
