<?php

namespace App\Contracts;

/**
 * Describes any entity which can be fetched
 */
interface Fetchable
{
    /**
     * This method should get any data from some source,
     * or return entity data from entity itself
     */
    public function fetch();
}
