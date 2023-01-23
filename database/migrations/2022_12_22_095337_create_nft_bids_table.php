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
        Schema::create('nft_bids', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bidder_id')->constrained('users');
            $table->foreignId('nft_id')->constrained('nft_entities');
            $table->double('total', 8, 6);
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
        Schema::dropIfExists('nft_bids');
    }
};
