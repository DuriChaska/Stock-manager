<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class AddLastLoginAtToUsersTable extends Migration
{

    public function up()
    {
        if (!Schema::hasColumn('users', 'last_login_at')) {
            Schema::table('users', function (Blueprint $table) {
                $table->timestamp('last_login_at')->nullable();
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('users', 'last_login_at')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('last_login_at');
            });
        }
    }
}





