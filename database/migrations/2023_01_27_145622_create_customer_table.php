<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* Schema::create('customer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        }); */

        DB::statement("
            CREATE TABLE IF NOT EXISTS customer(
                id 				bigint unsigned auto_increment not null,
                idn 		 	int(15),
                name		 	varchar(50),
                surname		 	varchar(50),
                address 	 	varchar(100),
                phone_number 	bigint(15),
                created_at	 	datetime,
                updated_at 	 	datetime,
                business_id     bigint unsigned not null,
                CONSTRAINT pk_customer PRIMARY KEY(id),
                CONSTRAINT fk_customer_business FOREIGN KEY(business_id) REFERENCES business(id) ON DELETE CASCADE ON UPDATE CASCADE
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
        Schema::dropIfExists('customer');
    }
}
