<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venues', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('uuid')->unsigned()->unique();
            $table->string('name')->nullable();
            $table->jsonb('json_data')->nullable();
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('uuid')->unsigned()->unique();
            $table->string('name');
            $table->jsonb('json_data')->nullable();
            $table->timestamps();
        });

        Schema::create('organizers', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('uuid')->unsigned()->unique();
            $table->string('name')->nullable();
            $table->jsonb('json_data')->nullable();
            $table->timestamps();
        });

        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug', 100);
            $table->float('longitude', 2, 7);
            $table->float('latitude', 2, 7);
            $table->timestamps();
        });

        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('uuid')->unsigned();
            $table->string('name');
            $table->string('eventbrite_url');
            $table->enum('status', ['draft', 'live', 'started', 'ended', 'canceled']);
            $table->string('currency', '3');
            $table->bigInteger('venue_uuid')->unsigned();
            $table->bigInteger('organizer_uuid')->unsigned();
            $table->bigInteger('location_id')->unsigned();
            $table->bigInteger('category_uuid')->unsigned()->nullable();
            $table->dateTime('started_at');
            $table->dateTime('ended_at');
            $table->jsonb('json_data')->nullable();
            $table->timestamps();
            $table->foreign('venue_uuid')->references('uuid')->on('venues');
            $table->foreign('organizer_uuid')->references('uuid')->on('organizers');
            $table->foreign('location_id')->references('id')->on('locations');
            $table->foreign('category_uuid')->references('uuid')->on('categories');
            $table->index('organizer_uuid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
        Schema::dropIfExists('venues');
        Schema::dropIfExists('organizers');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('locations');
    }
}
