<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSucursalesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sucursales', function(Blueprint $table)
		{
			$table->foreign('empresa_id', 'fk_sucursales_empresas')->references('id')->on('empresas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sucursales', function(Blueprint $table)
		{
			$table->dropForeign('fk_sucursales_empresas');
		});
	}

}
