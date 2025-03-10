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
        Schema::table('companies', function (Blueprint $table) {
            $table->string('email')->unique()->after('website');
            $table->string('phone')->nullable()->after('email');
        });
    
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('email')->unique()->after('position');
            $table->string('phone')->nullable()->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn(['email', 'phone']);
        });
    
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn(['email', 'phone']);
        });
    }
};
