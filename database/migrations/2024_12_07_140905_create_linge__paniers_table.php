<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ligne__paniers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('panier_id');
            $table->unsignedBigInteger('produit_id');
            $table->float('sous_total',10,2);
            $table->foreign('panier_id')->references('id')->on('paniers')
            ->onDelete('cascade');
            $table->Integer('quantite');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('linge__paniers');
    }
};
