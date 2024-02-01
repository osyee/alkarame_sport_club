<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Topfans ;
use App\Models\Associations;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Topfans>
 */
class TopfansFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model= Topfans ::class ;
    public function definition(): array
    {
        return [
            'association_id'=>$this->faker->randomElement(Associations::all())['id'],
        ];
    }
}
