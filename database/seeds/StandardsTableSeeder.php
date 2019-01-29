<?php

use Illuminate\Database\Seeder;

class StandardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->insert('BCA 1');
        $this->insert('BCA 2');
        $this->insert('BCA 3');
        $this->insert('BCom 1');
        $this->insert('BCom 2');
        $this->insert('BCom 3');
        $this->insert('BBA 1');
        $this->insert('BBA 2');
        $this->insert('BBA 3');
        $this->insert('BSc Computer Science 1');
        $this->insert('BSc Computer Science 2');
        $this->insert('BSc Computer Science 3');
    }

    private function insert($name)
    {
        DB::table('standards')->insert([
            'name' => $name,
            'user_id' => '1',
            'institute_id' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
