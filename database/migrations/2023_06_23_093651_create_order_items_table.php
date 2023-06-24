<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateOrderItemsTable.
 */
class CreateOrderItemsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_items', function(Blueprint $table) {
			$table->id();
            $table->foreignId('order_id')->constrained("orders");
            $table->foreignId('user_id')->constrained("users");
            $table->foreignId('product_id')->constrained("products");
            $table->string('product_name');
            $table->decimal('unit_price');
            $table->decimal('discount')->default(0);
            $table->integer('quantity');
            $table->integer('total');
            $table->text('extra')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->text('history')->nullable();
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
		Schema::drop('order_items');
	}
}
