<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DocType;

class DocTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DocType::factory()
        ->count(5)
        ->create();
    }
}
