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
        Schema::create('submissions', function (Blueprint $table) {
            $table->foreignId('id')->primary();
            $table->timestamps();
            $table->foreignUuid('collection_id')->constrained();
            $table->boolean('is_winner')->default(false);
            $table->string('name');
            $table->string('email');
            $table->string('phone_number');
            $table->text('comments')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
