<?php

use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('ingredients')->insert([
//            'name' => Str::random(10),
//            'cost' => random_int(1, 20)*10,
//        ]);
        factory('App\Ingredient', 10)->create();
    }
}
