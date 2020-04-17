<?php

use Illuminate\Database\Seeder;

class PizzaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pizzas')->insert([
            'name' => Str::random(10),
            'price' => random_int(5, 10)*100,
        ]);
    }
}
