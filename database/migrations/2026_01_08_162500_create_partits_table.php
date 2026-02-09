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
        Schema::create('partits', function (Blueprint $table) {
            $table->id();

            $table->foreignId('local_id')
                ->constrained('equips')
                ->cascadeOnDelete();

            $table->foreignId('visitant_id')
                ->constrained('equips')
                ->cascadeOnDelete();

            $table->foreignId('estadi_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->date('data');
            $table->integer('jornada');
            $table->integer('gols')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partits');
    }
};
