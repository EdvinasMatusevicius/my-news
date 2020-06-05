<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content')->nullable();
            $table->string('poster')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->boolean('active')->default(false);
            $table->timestamps();
        });
        Schema::table('articles',function(Blueprint $table){
            $table->foreign('user_id')
            ->on('users')
            ->references('id')
            ->onUpdate('CASCADE')
            ->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
