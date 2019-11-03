<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSucursalAdminTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sucursal_admin', function(Blueprint $table)
		{
			$table->foreign('sucursal_id', 'fk_sucursales_has_users_sucursales1')->references('id')->on('sucursales')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('user_id', 'fk_sucursales_has_users_users1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sucursal_admin', function(Blueprint $table)
		{
			$table->dropForeign('fk_sucursales_has_users_sucursales1');
			$table->dropForeign('fk_sucursales_has_users_users1');
		});
	}

}
