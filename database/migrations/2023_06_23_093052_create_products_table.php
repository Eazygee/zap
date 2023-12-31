<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
			$table->foreignId('user_id')->nullable()->constrianed('users');
			$table->string('name');
			$table->text('description');
			$table->string('price');
			$table->string('discount')->nullable();
			$table->string('reference' , 50)->unique();
            $table->text('sizes')->nullable();
            $table->string('status');
			$table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
