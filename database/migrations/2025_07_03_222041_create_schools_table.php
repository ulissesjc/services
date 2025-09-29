<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('inep')->unique()->nullable();
            $table->string('cnpj')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('city');
            $table->string('address');
            $table->boolean('has_lab');
            $table->boolean('has_resource_room');
            $table->timestamps();
        });

        DB::statement('CREATE UNIQUE INDEX schools_cnpj_unique ON schools (cnpj) WHERE cnpj IS NOT NULL;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};
