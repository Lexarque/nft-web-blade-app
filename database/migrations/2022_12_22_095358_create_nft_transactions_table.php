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
        Schema::create('nft_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nft_id')->constrained('nft_entities');
            $table->foreignId('buyer_id')->constrained('users');
            $table->string('contract_id', 100);
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
        Schema::dropIfExists('nft_transactions');
    }
};
