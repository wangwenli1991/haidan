<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMembers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     *
     * up()方法：
     */
    public function up()
    {
        if(!Schema::hasTable('members')) {
            Schema::create('members', function (Blueprint $table) {
                $table->increments('id');
                $table->char('account', 11)->unique()->default('')->comment('账号，手机号码');
                $table->string('password', 150)->default('')->comment('密码');
                $table->string('nickname', 191)->default('')->comment('昵称');
                $table->unsignedInteger('avator')->default(0)->comment('图像');
                $table->text('monologue')->comment('内心独白');
                $table->decimal('balance')->default('0.00')->comment('余额');
                $table->tinyInteger('sex')->default(0)->comment('性别，0代表未知');
                $table->year('year')->default('2000')->comment('出生年份');
                $table->char('month')->default('01')->comment('出生月份');
                $table->char('date')->default('01')->comment('出生日期');
                $table->unsignedSmallInteger('province')->default(0)->comment('省份ID');
                $table->unsignedSmallInteger('city')->default(0)->comment('城市ID');
                $table->string('qq', 20)->nullable()->comment('qq账号');
                $table->string('weixin', 100)->nullable()->comment('微信账号');
                $table->timestamps();//created_at 和 updated_at自动创建的两个字段，如果你不想要，改为（timestamps（false即可））
                $table->engine='Innodb';
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     *
     * down()方法：
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
