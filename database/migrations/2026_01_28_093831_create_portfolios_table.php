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
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();

            $table->string('title');           // ชื่อโปรเจค
            $table->string('subtitle');        // เช่น Shopping, Business Website
            $table->enum('type', ['app', 'website']); // แยก App / Website
            $table->string('tech_stack');      // Flutter, Laravel, etc.
            $table->string('image');           // รูปโลโก้
            $table->string('link')->nullable(); // ลิงก์เปิด app / website
            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
