<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    public function up(): void
    {
        if (!Schema::hasColumn('about_mes', 'name_th')) {
            Schema::table('about_mes', function (Blueprint $table) {
                $table->string('name_th')->nullable()->after('name');
                $table->string('position_th')->nullable()->after('position');
            });
        }

        if (!Schema::hasColumn('skills', 'title_th')) {
            Schema::table('skills', function (Blueprint $table) {
                $table->string('title_th')->nullable()->after('title');
            });
        }

        if (!Schema::hasColumn('experiences', 'company_th')) {
            Schema::table('experiences', function (Blueprint $table) {
                $table->string('company_th')->nullable()->after('company');
                $table->string('position_th')->nullable()->after('position');
                $table->text('description_th')->nullable()->after('description');
            });
        }

        if (!Schema::hasColumn('education', 'school_th')) {
            Schema::table('education', function (Blueprint $table) {
                $table->string('school_th')->nullable()->after('school');
                $table->string('degree_th')->nullable()->after('degree');
            });
        }

        if (!Schema::hasColumn('portfolios', 'title_th')) {
            Schema::table('portfolios', function (Blueprint $table) {
                $table->string('title_th')->nullable()->after('title');
                $table->text('description_th')->nullable()->after('description');
            });
        }
    }

    public function down(): void
    {
        Schema::table('about_mes', function (Blueprint $table) {
            $table->dropColumn(['name_th', 'position_th']);
        });

        Schema::table('skills', function (Blueprint $table) {
            $table->dropColumn(['title_th']);
        });

        Schema::table('experiences', function (Blueprint $table) {
            $table->dropColumn(['company_th', 'position_th', 'description_th']);
        });

        Schema::table('education', function (Blueprint $table) {
            $table->dropColumn(['school_th', 'degree_th']);
        });

        Schema::table('portfolios', function (Blueprint $table) {
            $table->dropColumn(['title_th', 'description_th']);
        });
    }
};
