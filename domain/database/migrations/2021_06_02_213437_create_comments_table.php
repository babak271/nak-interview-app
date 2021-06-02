<?php

use Domain\Content\Models\Comment;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create((new Comment())->getTable(), function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('model_id')->nullable();
            $table->string('model_type')->nullable();
            $table->string('type')->nullable();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');

            $table->foreignId('parent_id')
                ->nullable()
                ->constrained((new Comment())->getTable())
                ->onDelete('set null');

            $table->string('status')->nullable();
            $table->string('title')->nullable();
            $table->text('body')->nullable();
            $table->json('extra_data')->nullable();
            $table->ipAddress('ip_address')->nullable();
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
        Schema::dropIfExists((new Comment())->getTable());
    }
}
