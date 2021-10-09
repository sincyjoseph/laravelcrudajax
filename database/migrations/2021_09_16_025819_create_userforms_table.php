<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userforms', function (Blueprint $table) {
            $table->id();
            $table->string('username', 100);
            $table->text('password', 100);
            $table->string('email', 100);
            $table->string('phone')->length(11);
            $table->date('dateofbirth');
            $table->string('gender', 100);
            $table->text('address', 100);
            $table->string('declaration', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('userforms');
    }
}
