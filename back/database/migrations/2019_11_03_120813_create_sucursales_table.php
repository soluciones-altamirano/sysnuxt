<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSucursalesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sucursales', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nombre');
			$table->string('direccion');
			$table->char('telefono', 25);
			$table->string('email');
			$table->string('slug')->nullable();
            $table->integer('empresa_id')->index('fk_sucursales_empresas_idx');
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
		Schema::drop('sucursales');
	}

}
