<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* Schema::create('invoice', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        }); */

        DB::statement("
            CREATE TABLE IF NOT EXISTS invoice (
                id 				bigint unsigned auto_increment not null,
                pay_method	 	varchar(20),
                tax			 	int(2),
                created_at	 	datetime,
                updated_at	 	datetime,
                customer_id	 	bigint unsigned,
                user_id	 	    bigint unsigned,
                CONSTRAINT pk_invoice PRIMARY KEY(id),
                CONSTRAINT fk_invoice_customer FOREIGN KEY(customer_id) REFERENCES customer(id) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT fk_invoice_users FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
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
        Schema::dropIfExists('invoice');
    }
}
