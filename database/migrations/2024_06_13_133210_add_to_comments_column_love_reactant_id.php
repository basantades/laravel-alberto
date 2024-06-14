<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToUsersColumnLoveReactantId extends Migration
{
    public function up(): void
    {
         Schema::table('comments', function (Blueprint $table) {
             $table->unsignedBigInteger('love_reactant_id');
         });
    }
}

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('comments_column_love_reactant_id', function (Blueprint $table) {
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comments_column_love_reactant_id', function (Blueprint $table) {
            //
        });
    }
};
