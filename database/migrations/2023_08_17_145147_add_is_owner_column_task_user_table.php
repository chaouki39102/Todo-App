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
        Schema::table('task_user', function (Blueprint $table) {
            // add foreign key column for the task owner
            // $table->boolean(column: 'is_owner')->default(false)->after('user_id');
        });
    }

    public function down()
    {
        Schema::table('task_user', function (Blueprint $table) {
            //
        });
    }
};
