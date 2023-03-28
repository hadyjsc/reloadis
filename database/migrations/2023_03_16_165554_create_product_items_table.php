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
        if (!Schema::hasTable('product_items')) {
            Schema::create('product_items', function (Blueprint $table) {
                $table->id();
                $table->foreignId('product_id')->constrained('products', 'id');
                $table->string('serial_number', 100);
                $table->boolean('is_sold')->nullable();
                $table->timestamp('sold_at')->nullable();
                $table->integer('sold_by')->nullable();
                $table->foreignId('created_by')->constrained('users', 'id');
                $table->foreignId('updated_by')->nullable()->constrained('users', 'id');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_items');
    }
};
