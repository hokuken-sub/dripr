<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThemesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('themes', function($table)
		{
    		$table->increment('id');

            // user_id: 0 for a anonymous user
    		$table->integer('user_id')->unsigned()->default(0);
    		$table->string('title');
    		$table->string('description')->nullable();
    		$table->text('template');
    		$table->integer('votes')->unsigned()->default(0);
    		$table->integer('forks')->unsigned()->default(0);
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
		Schema::dropIfExists('themes');
	}

}
