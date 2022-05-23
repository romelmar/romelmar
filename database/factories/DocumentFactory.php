<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\OriginOffice;
use App\Models\MeansOfReceiving;
use App\Models\DocType;
use App\Models\Employee;
use App\Models\Status;

class DocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'origin_id' => OriginOffice::factory(),
            'mor_id' => MeansOfReceiving::factory(),
            'doctype_id' => DocType::factory(),
            'employee_id' => Employee::factory(),
            'date_received' => $this->faker->dateTimeThisCentury('+8 years')->format('Y-m-d'),
            'subject'   =>  $this->faker->sentence(),
            'control_number'   =>  $this->faker->randomDigit,
            'deadline' => $this->faker->dateTimeThisCentury('+8 years')->format('Y-m-d'),
            'action_taken'  =>  $this->faker->sentence(),
            'required_action'   =>  $this->faker->sentence(),
        ];
    }
}
