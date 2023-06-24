<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateOrdersTable.
 */
class CreateOrdersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained("users");
            $table->foreignId('delivery_address_id')->constrained("delivery_addresses");
            $table->string('reference')->unique();
            $table->decimal('amount');
            $table->decimal('discount')->default(0);
            $table->text("history")->nullable();
            $table->string('file')->nullable();
            $table->string('message')->nullable();
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
		Schema::drop('orders');
	}
}
