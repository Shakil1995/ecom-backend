<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username', 50);
            $table->string('email', 100);
            $table->string('password', 100);

            $table->string('name', 100)->nullable();            
            $table->string('avatar', 100)->nullable();
            $table->string('address', 500)->nullable();
            $table->string('phone', 15)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
