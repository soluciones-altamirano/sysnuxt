<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEmpresaResponsableTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('empresa_responsable', function(Blueprint $table)
		{
			$table->foreign('empresa_id', 'fk_empresas_has_users_empresas1')->references('id')->on('empresas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('user_id', 'fk_empresas_has_users_users1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('empresa_responsable', function(Blueprint $table)
		{
			$table->dropForeign('fk_empresas_has_users_empresas1');
			$table->dropForeign('fk_empresas_has_users_users1');
		});
	}

}
