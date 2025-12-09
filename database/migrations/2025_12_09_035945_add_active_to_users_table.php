<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddActiveToUsersTable extends Migration

{
    public function up()
    {
        if (!Schema::hasColumn('users', 'active')) {
            Schema::table('users', function (Blueprint $table) {
                $table->boolean('active')->default(true);
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('users', 'active')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('active');
            });
        }
    }

};
