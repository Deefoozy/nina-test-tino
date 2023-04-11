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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('age');
            $table->string('location');
            $table->string('personalities');

            $table->enum('diet', ['vegan', 'vegetarian', 'candy_only']);
            $table->enum('religion', ['christian', 'muslim', 'jewish', 'agnostic', 'atheist']);
            $table->enum('gender', ['M', 'F', 'NB']);

            // relations: allergies, languages
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('age');
            $table->dropColumn('location');
            $table->dropColumn('personalities');

            $table->dropColumn('diet');
            $table->dropColumn('religion');
            $table->dropColumn('gender');
        });
    }
};
