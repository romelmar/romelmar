<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Document;
use App\Models\Division;
use App\Models\Employee;


class DocRouteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'doc_id'        =>  Document::factory(),
            'division_id'   =>  Division::factory(),
            'employee_id'   =>  Employee::factory(),
            'date_received' =>  $this->faker->dateTimeThisCentury('+8 years')->format('Y-m-d'),
        ];
    }
}
