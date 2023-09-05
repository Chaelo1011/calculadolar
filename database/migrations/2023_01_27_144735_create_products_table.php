<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        /* Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        }); */

        DB::statement("
            CREATE TABLE IF NOT EXISTS products (
                id 						bigint unsigned auto_increment not null,
                name		 			varchar(100),
                brand		 			varchar(100),
                measurement	 			float(5,2),
                unit_of_measurement	 	varchar(10),
                description             text,
                dollar_buy_price 		float(12,3),
                unit_quantity	 		float(10,2),
                unit_stock		 		float(10,2),
                profit			 		int(3),
                dollar_sale_price	 	float(12,3) not null,
                wholesale_profit	 	int(3),
                dollar_wholesale_price 	float(15,3),
                bs_day			 		float(60,2),
                bs_cash_day		 		float(60,2),
                created_at		 		datetime,
                updated_at		 		datetime,
                user_id			 		bigint unsigned,
                category_id		 		bigint unsigned,
                CONSTRAINT pk_products PRIMARY KEY(id),
                CONSTRAINT fk_products_users FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT fk_products_category FOREIGN KEY (category_id) REFERENCES category(id) ON DELETE CASCADE ON UPDATE CASCADE
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
        Schema::dropIfExists('products');
    }
}
