<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Estate;
use App\Models\Option;
use App\Models\User;
use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Estate>
 */
class EstateFactory extends Factory
{
    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterMaking(function (Estate $estate) {
            //
        })->afterCreating(function (Estate $estate) {
            $name = [];
            $description = [];
            $values = [];

            $options = Option::with(['values'])
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get();

            foreach ($options as $option) {
                $value = $option->values->random();
                if (in_array($option->id, [1, 3])) {
                    $name[] = $value->name;
                }
                $description[] = $option->name . ': ' . $value->name;
                $values[$value->id] = ['sort_order' => $option->sort_order];
            }

            $estate->name = $estate->name . ': ' . implode(", ", $name);
            $estate->description = implode(", ", $description) . '.';
            $estate->update();

            $estate->values()->sync($values);
        });
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $location = Location::inRandomOrder()->first();
        $category = Category::inRandomOrder()->first();
        $name = $category->name;
        $createdAt = $this->faker->dateTimeBetween($startDate = '-3 days', $endDate = 'now');
        return [
            'location_id' => $location->id,
            'category_id' => $category->id,
            'price' => rand(1000, 1000000),
            'name' => $this->faker->unique()->name() . ' ' . $name,
            'phone' => rand(61000000, 65999999),
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraph(rand(1, 2)),
            'credit' => rand(0, 1),
            'swap' => rand(0, 1),
            'yard' => rand(0, 1),
            'lift' => rand(0, 1),
            'balcony' => rand(0, 1),
            'random' => rand(0, 999999),
            'created_at' => $createdAt,
        ];
    }
}
