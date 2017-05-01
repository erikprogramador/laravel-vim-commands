<?php

use Illuminate\Database\Seeder;

class CommandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Command::class, 200)->create();
    }
}
