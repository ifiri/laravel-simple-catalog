<?php

namespace App\Listeners;

use App\Events\ModelSaving;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Listener for ModelSaving event.
 * Get fillable fields from Model and sync Model data
 * with fillable ones. If Model have any non-fillable field,
 * remove it from model.
 */
class SyncWithFillableFields
{
    /**
     * Handle the event.
     *
     * @param  ModelSaving  $event
     * @return void
     */
    public function handle(ModelSaving $Event)
    {
        $Model = $Event->getModel();

        try {
            $fillables = $Model->getFillableFields();

            $this->sync($Model, $fillables);
        } catch(\Throwable $Exception) {
            throw $Exception;
        }
    }

    /**
     * Sync model fields with passed fields
     * @param Model $Model 
     * @param array $syncFields 
     * @return void
     */
    private function sync(Model $Model, array $syncFields) 
    {
        $modelFields = $Model->attributesToArray();

        foreach ($modelFields as $key => $value) {
            if(!in_array($key, $fillables)) {
                unset($Model->{$key});
            }
        }
    }
}
