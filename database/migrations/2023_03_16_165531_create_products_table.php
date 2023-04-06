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
        if (!Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->foreignId('category_id')->constrained('categories', 'id')->nullable();;
                $table->foreignId('sub_category_id')->constrained('sub_categories', 'id')->nullable();;
                $table->foreignId('provider_id')->constrained('providers', 'id')->nullable();;
                $table->string('quota', 5);
                $table->string('unit', 10);
                $table->string('description', 255)->nullable();
                $table->decimal('price', 18, 2);
                $table->decimal('fund', 18, 2)->nullable();
                $table->timestamp('fund_date')->nullable();
                $table->boolean('stocked')->default('0');
                $table->timestamp('expired_at');
                $table->boolean('is_deleted')->default('0');
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
        Schema::dropIfExists('products');
    }
};
