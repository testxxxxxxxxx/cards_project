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
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->decimal("number", 20, 0)->unique()->nullable(false);
            $table->decimal("PIN", 4, 0)->nullable(false);
            $table->dateTime("activate")->nullable(false);
            $table->date("validity")->nullable(false);
            $table->bigInteger("balance")->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
