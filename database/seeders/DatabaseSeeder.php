<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Gig;
use App\Models\Review;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create categories
        $categories = Category::factory()->createMany([
            ['name' => 'Web Development', 'slug' => 'web-development'],
            ['name' => 'Graphic Design', 'slug' => 'graphic-design'],
            ['name' => 'Digital Marketing', 'slug' => 'digital-marketing'],
            ['name' => 'Writing & Translation', 'slug' => 'writing-translation'],
            ['name' => 'Video & Animation', 'slug' => 'video-animation'],
        ]);

        // Create users
        $sellers = User::factory(10)->create();
        $buyers = User::factory(20)->create();

        // Create gigs
        $gigs = Gig::factory(50)->create([
            'category_id' => fn() => $categories->random()->id,
            'seller_id' => fn() => $sellers->random()->id,
        ]);

        // Create reviews
        foreach ($gigs as $gig) {
            Review::factory(rand(0, 15))->create([
                'gig_id' => $gig->id,
                'user_id' => fn() => $buyers->random()->id,
            ]);
        }
    }
}