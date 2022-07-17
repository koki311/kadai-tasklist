<?php

use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 15; $i++) {
            DB::table('tasks')->insert([
                'content' => 'content ' . $i,
                'status' => 'status ' . $i
                'user_id' => 1,
            ]);
        }
 
    }
}
