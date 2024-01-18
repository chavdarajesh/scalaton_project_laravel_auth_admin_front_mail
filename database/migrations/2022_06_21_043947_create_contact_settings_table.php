<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_settings', function (Blueprint $table) {
            $table->id();
            $table->enum('static_id',[1]);
	        $table->string('email')->nullable();
	        $table->string('phone')->nullable();
	        $table->string('location')->nullable();
	        $table->text('map_iframe')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_settings');
    }
}
