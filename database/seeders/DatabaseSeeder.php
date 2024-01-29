<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Customer;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\LeadSource;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //user Admin
        User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'admin@admin.com',
        ]);


        //10 Customers
        Customer::factory()
            ->count(10)
            ->create();

        //lead-resource
        $leadSources = [
            'Website',
            'Online AD',
            'Twitter',
            'LinkedIn',
            'Webinar',
            'Trade Show',
            'Referral',
        ];

        foreach ($leadSources as $leadSource) {
            LeadSource::create(['name' => $leadSource]);
        }


        //Tgs seeder
        $tags = [
            'Priority',
            'VIP'
        ];

        foreach ($tags as $tag) {
            Tag::create(['name' => $tag]);
        }
    }
}
