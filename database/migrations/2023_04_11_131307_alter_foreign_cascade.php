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
        Schema::table('allergies_users', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['allergy_id']);

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');
            $table->foreign('allergy_id')
                ->references('id')
                ->on('allergies')
                ->onDelete('CASCADE');
        });

        Schema::table('languages_users', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['language_id']);

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');
            $table->foreign('language_id')
                ->references('id')
                ->on('languages')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('allergies_users', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['allergy_id']);

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('allergy_id')->references('id')->on('allergies');
        });

        Schema::table('languages_users', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['language_id']);

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('language_id')->references('id')->on('languages');
        });
    }
};
