<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laboratory_id')->constrained('laboratories');
            $table->foreignId('code_id')->constrained('codes');
            $table->string('name');
            $table->string('dci');
            $table->string('form');
            $table->string('dosage');
            $table->string('packaging');
            $table->boolean('is_generic')->default(true);
            $table->boolean('is_local')->default(true);
            $table->string('label');
            $table->string('slug');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};
