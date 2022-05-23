<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DocRoute;

class DocRouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DocRoute::factory()
        ->count(10)
        ->create();
    }
}
