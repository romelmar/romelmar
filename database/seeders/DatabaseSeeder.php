<?php
namespace Database\Seeders;

use App\Models\Division;
use App\Models\DocRoute;
use App\Models\MeansOfReceiving;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call([UsersTableSeeder::class]);
        $this->call([DivisionSeeder::class]);
        $this->call([DocTypeSeeder::class]);
        $this->call([EmployeeSeeder::class]);
        $this->call([MeansOfReceivingSeeder::class]);
        $this->call([OriginOfficeSeeder::class]);
        $this->call([StatusSeeder::class]);
        $this->call([DocumentSeeder::class]);
        $this->call([DocRouteSeeder::class]);
    }
}
