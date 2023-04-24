<?php

namespace Database\Factories;

use App\Models\Scanbarcode;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ScanbarcodeFactory extends Factory
{
    protected $model = Scanbarcode::class;

    public function definition()
    {
        return [
			'barcode' => $this->faker->name,
        ];
    }
}
