<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* Schema::create('category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        }); */

        DB::statement("
            CREATE TABLE IF NOT EXISTS category (
                id					 bigint unsigned auto_increment not null,
                name				 varchar(100),
                description			 varchar(100),
                created_at		 	 datetime,
                updated_at			 datetime,
                CONSTRAINT pk_category PRIMARY KEY(id)
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
        Schema::dropIfExists('category');
    }
}
