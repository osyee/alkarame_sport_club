<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Matches ;
use App\Models\Statistics ;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Statistics>
 */
class StatisticsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model= Statistics ::class ;
    public function definition(): array
    {
        return [
            'uuid' => Str::uuid(),
            'name' =>$this->faker->name,
            'vaalue' =>$this->faker->text,
            'matches_id'=>$this->faker->randomElement(Matches::all())['id'],
        ];
    }
}
