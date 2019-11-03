<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSucursalAdminTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sucursal_admin', function(Blueprint $table)
		{
			$table->integer('sucursal_id')->index('fk_sucursales_has_users_sucursales1_idx');
			$table->bigInteger('user_id')->unsigned()->index('fk_sucursales_has_users_users1_idx');
			$table->dateTime('asignado')->nullable();
			$table->dateTime('desasignado')->nullable();
			$table->primary(['sucursal_id','user_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sucursal_admin');
	}

}
