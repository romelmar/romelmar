<?php

namespace Database\Seeders;

use App\Models\DocStatus;
use Illuminate\Database\Seeder;
use App\Models\DocStatuses;

class DocStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DocStatus::factory()
        ->count(20)
        ->create();
    }
}
