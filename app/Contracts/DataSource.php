<?php

namespace App\Contracts;

/**
 * Describes any class that can provide fetchable source
 */
interface DataSource extends Fetchable
{
    /**
     * Should return any fetchable source
     */
    public function source();
}
