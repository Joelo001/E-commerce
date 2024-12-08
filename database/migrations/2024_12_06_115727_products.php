<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('produits', function (Blueprint $table) {
            $table->string('name');
            $table->text('description')->nullable();
            $table->float('prix',8,2);
            $table->integer('stock');
            $table->boolean('active');
            
        });
        DB::statement('ALTER TABLE produits ADD CONSTRAINT chek_price CHECK(prix>0)');
        DB::statement('ALTER TABLE produits ADD CONSTRAINT chek_stock CHECK(stock>0)');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produits', function (Blueprint $table) {
            //
        });
    }
};
