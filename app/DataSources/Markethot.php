<?php

namespace App\DataSources;

use App\{
    Contracts\DataSource,
    Exceptions\EmptySourceException
};

use Ixudra\Curl\Facades\Curl;

/**
 * Markethot fetchable source. Provides interface to fetch latest products
 * from markethot.ru
 */
class Markethot implements DataSource
{
    private const SOURCE_URL = 'https://markethot.ru/export/bestsp';

    public function fetch(): iterable 
    {
        $source = $this->source();
        $response = Curl::to($source)->asJson()->get();

        if(!$response->products) {
            throw new EmptySourceException('Source response should contain products!');
        }

        return $response->products;
    }

    public function source(): string 
    {
        return $this::SOURCE_URL;
    }
}
