<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateDollarUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* Schema::create('dollar_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        }); */
        DB::statement("
            CREATE TABLE IF NOT EXISTS dollar_user (
                id 				          bigint unsigned auto_increment not null,
                dolar_user_transference   float(10,2),
                dollar_user_cash          float(10,2),
                created_at	 	          datetime,
                updated_at	 	          datetime,
                user_id	 	              bigint unsigned,
                CONSTRAINT pk_sale_details PRIMARY KEY(id),
                CONSTRAINT fk_dollarUser_user FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
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
        Schema::dropIfExists('dollar_user');
    }
}
