<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
//        Schema::create('dci_medicine', function (Blueprint $table) {
//            $table->id();
//            $table->foreignId('medicine_id')->constrained('medicines');
//            $table->foreignId('dci_id')->constrained('dcis');
//            $table->string('dosage');
//            $table->timestamps();
//        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dci_medicine');
    }
};
