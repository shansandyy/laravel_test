<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogErrors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_errors', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->default(0);
            $table->text('exception')->nullable(0);  // 錯誤類別
            $table->text('message')->nullable();  // 錯誤訊息
            $table->integer('line')->nullable();  // 在第幾行
            $table->json('trace')->nullable();  // 紀錄牽動引用程式
            $table->string('method')->nullable();  // client method
            $table->json('params')->nullable();  // 參數
            $table->text('uri')->nullable();  // 打進來的url
            $table->text('user_agent')->nullable();  // 瀏覽器            
            $table->json('header')->nullable();  // 使用者屬性           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_errors');
    }
}
