<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('activity_logs', function (Blueprint $table) {
            if (!Schema::hasColumn('activity_logs', 'model')) {
                $table->string('model')->nullable()->after('action');
            }
            if (!Schema::hasColumn('activity_logs', 'model_id')) {
                $table->string('model_id')->nullable()->after('model');
            }
        });
    }

    public function down()
    {
        Schema::table('activity_logs', function (Blueprint $table) {
            $table->dropColumn(['model', 'model_id']);
        });
    }
};
