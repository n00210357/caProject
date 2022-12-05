<?php

namespace Database\Seeders;

use App\Models\destination;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

     //when this is run it attempts to use factory to input 10 filler destinations into the destination table of the database
    public function run()
    {
        Destination::factory()->times(3)->hasTrains(4)->create();
    }
}
