<?php

namespace Database\Factories;

use App\Models\Asistencia;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AsistenciaFactory extends Factory
{
    protected $model = Asistencia::class;

    public function definition()
    {
        return [
			'barcode' => $this->faker->name,
			'status' => $this->faker->name,
			'asistencia_date' => $this->faker->name,
			'asistencia_time' => $this->faker->name,
			'empleado_id' => $this->faker->name,
        ];
    }
}
