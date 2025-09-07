<?php

namespace Database\Seeders;

use App\Helpers\Credly;
use App\Models\Certification;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed a demo user
        if (! User::query()->where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }

        // Demo certifications (idempotent via slug)
        $items = [
            [
                'title' => 'Project Management Professional (PMP)',
                'issuer' => 'PMI',
                'issued_at' => now()->subYears(2)->startOfMonth(),
                'uuid' => '123e4567-e89b-12d3-a456-426614174000',
                'is_published' => true,
                'sort_order' => 0,
            ],
            [
                'title' => 'Professional Scrum Master I (PSM I)',
                'issuer' => 'Scrum.org',
                'issued_at' => now()->subYear()->startOfMonth(),
                'uuid' => 'f47ac10b-58cc-4372-a567-0e02b2c3d479',
                'is_published' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Professional Scrum Product Owner I (PSPO I)',
                'issuer' => 'Scrum.org',
                'issued_at' => now()->subMonths(6)->startOfMonth(),
                'uuid' => '9b2f1b90-1d61-4a54-8b57-4d23a1b4567a',
                'is_published' => true,
                'sort_order' => 2,
            ],
        ];

        foreach ($items as $i) {
            $slug = Str::slug($i['title']);
            $url = sprintf('https://www.credly.com/badges/%s/public_url', $i['uuid']);
            $embed = Credly::iframeFromUrl($url, 150, 150);

            Certification::updateOrCreate(
                ['slug' => $slug],
                [
                    'title' => $i['title'],
                    'issuer' => $i['issuer'],
                    'issued_at' => $i['issued_at'],
                    'credly_url' => $url,
                    'embed_html' => $embed,
                    'is_published' => $i['is_published'],
                    'sort_order' => $i['sort_order'],
                ]
            );
        }
    }
}
