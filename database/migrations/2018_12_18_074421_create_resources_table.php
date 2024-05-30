<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(0);
            $table->integer('isfolder')->default(0);
            $table->integer('menuindex')->default(0);
            $table->string('de_title');
            $table->string('de_meta_title')->nullable();
            $table->text('de_meta_description')->nullable();
            $table->text('de_meta_keywords')->nullable();
            $table->text('de_content')->nullable();
            $table->string('de_alias')->nullable();
            $table->string('de_uri')->nullable();
            $table->tinyInteger('de_menushow')->default(1);
            $table->tinyInteger('de_published')->default(1);
            $table->string('ru_title')->nullable();
            $table->string('ru_meta_title')->nullable();
            $table->text('ru_meta_description')->nullable();
            $table->text('ru_meta_keywords')->nullable();
            $table->text('ru_content')->nullable();
            $table->string('ru_alias')->nullable();
            $table->string('ru_uri')->nullable();
            $table->tinyInteger('ru_menushow')->default(1);
            $table->tinyInteger('ru_published')->default(1);
            $table->tinyInteger('use_gallery')->default(0);
            $table->integer('per_page')->default(12);
            $table->integer('created_by')->nullable();
            $table->integer('modified_by')->nullable();
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
        Schema::dropIfExists('resources');
    }
}
