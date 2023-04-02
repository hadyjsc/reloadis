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
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 100);
            $table->string('sender', 100)->nullable();
            $table->foreignId('bank_id')->nullable()->constrained('banks', 'id');
            $table->string('bank_account', 30);
            $table->string('receiver', 100)->nullable();
            $table->decimal('amount', 18, 2);
            $table->string('status', 20);
            $table->string('note', 255)->nullable();
            $table->string('receipt', 255)->nullable();
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
        Schema::dropIfExists('transfers');
    }
};
