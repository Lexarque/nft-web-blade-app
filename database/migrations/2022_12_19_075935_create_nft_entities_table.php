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
        Schema::create('nft_entities', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->string('nft_number', 50);
            $table->string('image');
            $table->text('description');
            $table->string('contract_id');
            $table->integer('likes')->default(0);
            $table->integer('price');
            $table->string('status', 25)->default('Pending');
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('owned_by')->nullable()->constrained('users');
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
        Schema::dropIfExists('nft_entities');
    }
};
