<?php

namespace App\Events;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;

/**
 * Event that fires when model tries to save its data.
 */
class ModelSaving
{
    use Dispatchable;

    private $Model;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Model $Model)
    {
        $this->Model = $Model;
    }

    /**
     * Returns model that binds to this event.
     * 
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModel(): Model 
    {
        return $this->Model;
    }
}
