<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_types', function (Blueprint $table) {
            $table->id();
            $table->string('room_type')->unique();
            $table->decimal('price',10,2);
            $table->string('capacity');
            $table->string('bed');
            $table->string('facility');
            $table->string('description')->nullable();
            $table->string('status')->default('active');
            $table->string('kitchen')->nullable();
             $table->string('bedroom')->nullable();
             $table->string('bathroom')->nullable();
             $table->string('view')->nullable();



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
        Schema::dropIfExists('room_types');
    }
}
