<?php

namespace Database\Factories;

use App\Models\Empleado;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EmpleadoFactory extends Factory
{
    protected $model = Empleado::class;

    public function definition()
    {
        return [
			'barcode' => $this->faker->name,
			'name' => $this->faker->name,
			'status' => $this->faker->name,
			'depto' => $this->faker->name,
        ];
    }
}
