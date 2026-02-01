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
       Schema::table('education', function (Blueprint $table) {
            if (!Schema::hasColumn('education', 'about_me_id')) {
                $table->foreignId('about_me_id')
                    ->nullable()
                    ->after('id')
                    ->constrained('about_mes')
                    ->cascadeOnDelete();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('education', function (Blueprint $table) {
            $table->dropForeign(['about_me_id']);
            $table->dropColumn('about_me_id');
        });
    }
};
