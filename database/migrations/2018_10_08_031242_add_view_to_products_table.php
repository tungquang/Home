<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddViewToProductsTable extends Migration
{
    protected  $value = false;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('view')->after('quantily')->default($this->value);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('view')->after('quantily')->default($this->value);
        });
    }
}
