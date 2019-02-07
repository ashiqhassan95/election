<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->insert('Chairman');
        $this->insert('Representative');
        $this->insert('Secretory');
        $this->insert('President');
        $this->insert('Heady Boy');
        $this->insert('Heady Girl');
    }

    private function insert($title)
    {
        DB::table('positions')->insert([
            'title' => $title,
            'user_id' => '3',
            'institute_id' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
