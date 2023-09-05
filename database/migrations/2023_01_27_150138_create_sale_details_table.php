<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class CreateSaleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* Schema::create('sale_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        }); */

        DB::statement("
            CREATE TABLE IF NOT EXISTS sale_details (
                id 				bigint unsigned auto_increment not null,
                quantity 		float(10,2),
                discount	 	int(3),
                created_at	 	datetime,
                updated_at	 	datetime,
                product_id	 	bigint unsigned,
                invoice_id	 	bigint unsigned,
                CONSTRAINT pk_sale_details PRIMARY KEY(id),
                CONSTRAINT fk_sale_product FOREIGN KEY(product_id) REFERENCES products(id) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT fk_sale_invoice FOREIGN KEY(invoice_id) REFERENCES invoice(id) ON DELETE CASCADE ON UPDATE CASCADE
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
        Schema::dropIfExists('sale_details');
    }
}
