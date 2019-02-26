<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableMembersAddDistinct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('members', function (Blueprint $table) {
            //添加地区字段 用命令：php artisan make:migration alter_table_members_add_distinct --table=members
            //下了下面的代码之后，再执行命令：php artisan migrate即可添加成功
            $table->smallInteger('distinct')->default(0)->comment('所在地区');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('members', function (Blueprint $table) {
            //
            $table->dropColumn('distinct');
        });
    }
}
