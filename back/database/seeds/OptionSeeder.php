<?php

use App\Models\Option;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Option::class,10)->create()->each(function (Option $option){
           factory(Option::class,rand(1,5))->create(['option_id' => $option->id])->each(function (Option $option){
               factory(Option::class,rand(1,5))->create(['option_id' => $option->id]);
           });
        });
    }
}
