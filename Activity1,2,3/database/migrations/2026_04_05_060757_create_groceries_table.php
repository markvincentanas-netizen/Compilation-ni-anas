<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('groceries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category');
            $table->integer('quantity');
            $table->decimal('price', 8, 2);
            $table->date('expiry_date');
            $table->string('image')->nullable(); // 🖼 IMAGE
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('groceries');
    }
};