<?php

namespace Database\Seeders;

use App\Models\driver;
use App\Models\train;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    //runs driverFactory.php when called in terminal

    //when this is run it attempts to use factory to input 10 filler drivers into the driver table of the database
    public function run()
    {
        driver::factory()->times(3)->create();

        foreach(train::all() as $train)
        {
            $drivers = driver::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $train->driver()->attach($drivers);
        }
    }
}
