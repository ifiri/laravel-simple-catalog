<?php

namespace App\Jobs;

use App\Exceptions\SourceException;
use App\Contracts\{
    DataSource, DataStorage
};

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CatalogUpdate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    /**
     * Source that provides raw products data
     * 
     * @var \App\Contracts\DataSource
     */
    private $Source;

    /**
     * Storage that storing all products into a destination place
     * 
     * @var \App\Contracts\DataSource
     */
    private $Storage;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        DataSource $Source,
        DataStorage $Storage
    )
    {
        $this->Source = $Source;
        $this->Storage = $Storage;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $products = $this->Source->fetch();

            $this->Storage->store($products);
        } catch(\Throwable $Exception) {
            throw $Exception;
        }
    }
}
