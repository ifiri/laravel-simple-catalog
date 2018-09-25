<?php

namespace App\Storages;

use App\{
    Eloquent,
    Contracts\DataStorage,
    Exceptions\EmptySourceException
};

use Ixudra\Curl\Facades\Curl;

/**
 * Implementation of DataStorage interface.
 * Storing passed products collection into a database.
 */
class Products implements DataStorage
{
    /**
     * Set every product from collection to eloquent models.
     * 
     * @param iterable $products 
     * @return void
     */
    public function store(iterable $products)
    {
        foreach ($products as $product) {
            $ProductEntity = Eloquent\Products::updateOrCreate(['id' => $product->id], get_object_vars($product));

            $offers = $this->createModelsBy(Eloquent\Offers::class, $product->offers);
            $categories = $this->createModelsBy(Eloquent\Categories::class, $product->categories);

            $ProductEntity->categories()->sync(array_keys($categories));
            $ProductEntity->offers()->sync(array_keys($offers));
        }
    }

    /**
     * Creates entities by passed absolute classname,
     * and set it up with passed array of fields.
     * 
     * This method using for get eloquent representation of
     * raw product-related entities.
     * 
     * @param string $class 
     * @param array $entities 
     * @return array
     */
    private function createModelsBy(string $class, array $entities): array 
    {
        if(!class_exists($class)) {
            throw new \RuntimeException('No model class exists for {' . $class . '}');
        }

        $models = [];
        foreach ($entities as $index => $entity) {
            $fields = get_object_vars($entity);

            // Try update or create model with passed fields
            try {
                $Model = $class::updateOrCreate([
                    'id' => $entity->id
                ], array_filter($fields));

                $models[$Model->id] = $Model;
            } catch(\Exception $Exception) {
                // We need only log message and store next item
                \Log::error($Exception->getMessage());

                continue;
            }
        }

        return $models;
    }
}
