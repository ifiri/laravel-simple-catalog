<?php

namespace App\Eloquent\Traits;

/**
 * Add to model possibility to share its fillable fields with other entities.
 */
trait ProvidingFillable
{
    /**
     * Just return model fillables.
     * 
     * @return type
     */
    public function getFillableFields(): array {
        return $this->fillable;
    }
}
