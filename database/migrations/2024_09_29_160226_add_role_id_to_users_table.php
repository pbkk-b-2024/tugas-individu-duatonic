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
            $table->char('role_id', 6)->after('password'); // Add the role_id column
            $table->foreign('role_id')->references('role_id')->on('roles')->onDelete('cascade'); // Add the foreign key constraint
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']); // Drop the foreign key constraint
            $table->dropColumn('role_id'); // Drop the role_id column
        });
    }
};
