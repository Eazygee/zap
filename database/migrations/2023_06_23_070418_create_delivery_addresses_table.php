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
        Schema::create('delivery_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained("users")->cascadeOnDelete();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('apartment_no')->nullable();
            $table->text('address');
            $table->string('zip_code')->nullable();
            $table->text('city')->nullable();
            $table->text('state');
            $table->text('country');
            $table->string('phone');
            $table->string('phone_2')->nullable();
            $table->tinyInteger('is_default')->default(0);
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
        Schema::dropIfExists('delivery_addresses');
    }
};
