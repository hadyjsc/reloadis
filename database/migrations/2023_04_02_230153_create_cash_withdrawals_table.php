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
        Schema::create('cash_withdrawals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bank_id')->nullable()->constrained('banks', 'id');
            $table->decimal('amount', 18, 2);
            $table->decimal('external_fee', 18, 2);
            $table->decimal('internal_fee', 18, 2);
            $table->foreignId('created_by')->constrained('users', 'id');
            $table->foreignId('updated_by')->nullable()->constrained('users', 'id');
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
        Schema::dropIfExists('cash_withdrawals');
    }
};
