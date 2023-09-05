<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* Schema::create('business', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        }); */

        DB::statement("
            CREATE TABLE IF NOT EXISTS business (
                id					 bigint unsigned auto_increment not null,
                name				 varchar(100),
                city				 varchar(50),
                state				 varchar(50),
                address				 varchar(100),
                description		  	 varchar(100),
                rif				  	 varchar(100),
                logo_path		  	 varchar(100),
                created_at			 datetime,
                updated_at			 datetime,
                user_id				 bigint unsigned,
                CONSTRAINT pk_business PRIMARY KEY(id),
                CONSTRAINT fk_business_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
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
        Schema::dropIfExists('business');
    }
}
