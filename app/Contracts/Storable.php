<?php

namespace App\Contracts;

/**
 * Describes class that can store provided iterable data somewhere
 */
interface Storable
{
    /**
     * This method should set passed data to external storage.
     * Should return nothing.
     * 
     * @param iterable $data 
     * @return void
     */
    public function store(iterable $data);
}
