<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $prefix = DB::getTablePrefix();

        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title', 255);
            $table->string('image', 255)->nullable();
            $table->text('description')->nullable();
            $table->datetime('first_invoice')->nullable();
            $table->string('url', 150)->nullable();
            $table->float('price', 9, 2)->unsigned();
            $table->integer('amount')->unsigned()->default(0);

            $table->timestamps();
        });

        // We forced to use raw statements because Laravel not supported fulltext indexes
        DB::statement("ALTER TABLE `{$prefix}products` ADD FULLTEXT INDEX idx_title(`title`)");
        DB::statement("ALTER TABLE `{$prefix}products` ADD FULLTEXT INDEX idx_description(`description`)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
