<?php

use Illuminate\Database\Seeder;

class ElectionDBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(StandardsTableSeeder::class);
        $this->call(PositionsTableSeeder::class);
    }
}
