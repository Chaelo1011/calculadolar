<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class CreateProductCatalogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* Schema::create('product_catalog', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        }); */

        DB::statement("
            CREATE TABLE IF NOT EXISTS product_catalog (
                id 					bigint unsigned auto_increment not null,
                image_path	 		varchar(100),
                description	 		text,
                position            int(1),
                created_at	 		datetime,
                updated_at	 		datetime,
                product_id	 		bigint unsigned,
                CONSTRAINT pk_catalog PRIMARY KEY(id),
                CONSTRAINT fk_catalog_product FOREIGN KEY(product_id) REFERENCES products(id) ON DELETE CASCADE ON UPDATE CASCADE
            )ENGINE=InnoDb;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_catalog');
    }
}
