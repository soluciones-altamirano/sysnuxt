<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmpresaResponsableTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('empresa_responsable', function(Blueprint $table)
		{
			$table->integer('empresa_id')->index('fk_empresas_has_users_empresas1_idx');
			$table->bigInteger('user_id')->unsigned()->index('fk_empresas_has_users_users1_idx');
			$table->dateTime('asignado')->nullable();
			$table->dateTime('desasignado')->nullable();
			$table->primary(['empresa_id','user_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('empresa_responsable');
	}

}
