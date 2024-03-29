<?php

use Domain\Content\Models\Post;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create((new Post())->getTable(), function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status')->default(\Domain\Content\Enums\PostStatus::ACTIVE);
            $table->string('slug')->nullable();
            $table->string('title')->nullable();
            $table->text('body');
            $table->softDeletes();
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
        Schema::dropIfExists((new Post())->getTable());
    }
}
