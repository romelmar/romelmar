<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OriginOffice;

class OriginOfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OriginOffice::factory()
        ->count(5)
        ->create();
    }
}
