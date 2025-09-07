<?php

namespace Database\Factories;

use App\Models\Certification;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Certification>
 */
class CertificationFactory extends Factory
{
    protected $model = Certification::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'issuer' => $this->faker->company(),
            'issued_at' => $this->faker->date(),
            'credly_url' => $this->faker->url(),
            'embed_html' => '<iframe></iframe>',
            'is_published' => true,
            'sort_order' => 0,
        ];
    }
}
