<?php

namespace Database\Seeders;

use App\Models\train;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    //runs trainFactory.php when called in terminal

    //when this is run it attempts to use factory to input 10 filler trains into the train table of the database
    public function run()
    {
        train::factory()->times(10)->create();
    }
}
