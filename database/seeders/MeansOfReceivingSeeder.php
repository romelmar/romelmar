<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MeansOfReceiving;

class MeansOfReceivingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MeansOfReceiving::factory()
        ->count(5)
        ->create();
    }
}
