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
        Schema::table('results', function (Blueprint $table) {
            $table->string('co')->nullable()->after('result');
            $table->string('hc')->nullable()->after('co');
            $table->string('co2')->nullable()->after('hc');
            $table->string('o2')->nullable()->after('co2');
            $table->string('lambda')->nullable()->after('o2');
            $table->string('nox')->nullable()->after('lambda');
            $table->string('passed_or_failed')->nullable()->after('nox');
            $table->string('purpose')->nullable()->after('passed_or_failed');
            $table->text('attachment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('results', function (Blueprint $table) {
            $table->dropColumn('co');
            $table->dropColumn('hc');
            $table->dropColumn('co2');
            $table->dropColumn('o2');
            $table->dropColumn('lambda');
            $table->dropColumn('nox');
            $table->dropColumn('passed_or_failed');
            $table->dropColumn('purpose');
            $table->dropColumn('attachment');
        });
    }
};
