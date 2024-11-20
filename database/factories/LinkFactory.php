<?php

namespace Database\Factories;

use App\Models\Link;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Link>
 */
class LinkFactory extends Factory
{
    protected $model = Link::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $slug = strtolower(Str::random(8));
        $redirectUrl = "http://localhost:8000/".$slug;

        return [
            "target_url" => fake()->url(),
            "slug" => $slug,
            "redirect_url" => $redirectUrl,
        ];
    }
}
