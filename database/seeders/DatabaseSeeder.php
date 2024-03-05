<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Customer;
use App\Models\CustomField;
use App\Models\PipelineStage;
use App\Models\Product;
use App\Models\Role;
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
            'role_id' => Role::where('name', 'Admin')->first()->id,
        ]);

        // We will seed 10 employees
        //User::factory()->count(10)->create([
        //    'role_id' => Role::where('name', 'Employee')->first()->id,
        //]);


        //10 Customers
        //Customer::factory()
        //    ->count(10)
         //   ->create();

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

        // Pipeline-Stages
        $pipelineStages = [
            [
                'name' => 'Lead',
                'position' => 1,
                'is_default' => true,
            ],
            [
                'name' => 'Contact Made',
                'position' => 2,
            ],
            [
                'name' => 'Proposal Made',
                'position' => 3,
            ],
            [
                'name' => 'Proposal Rejected',
                'position' => 4,
            ],
            [
                'name' => 'Customer',
                'position' => 5,
            ]
        ];

        foreach ($pipelineStages as $stage) {
            PipelineStage::create($stage);
        }

        $defaultPipelineStage = PipelineStage::where('is_default', true)->first()->id;
        Customer::factory()->count(10)->create([
            'pipeline_stage_id' => $defaultPipelineStage,
        ]);

        //
        $customFields = [
            'Birth Date',
            'Company',
            'Job Title',
            'Family Members',
        ];

        foreach ($customFields as $customField) {
            CustomField::create(['name' => $customField]);
        }


        //Roles Creation
        $roles = [
            'Admin',
            'Employee'
        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }


        // Products
        $products = [
            ['name' => 'Product 1', 'price' => 12.99],
            ['name' => 'Product 2', 'price' => 2.99],
            ['name' => 'Product 3', 'price' => 55.99],
            ['name' => 'Product 4', 'price' => 99.99],
            ['name' => 'Product 5', 'price' => 1.99],
            ['name' => 'Product 6', 'price' => 12.99],
            ['name' => 'Product 7', 'price' => 15.99],
            ['name' => 'Product 8', 'price' => 29.99],
            ['name' => 'Product 9', 'price' => 33.99],
            ['name' => 'Product 10', 'price' => 62.99],
            ['name' => 'Product 11', 'price' => 42.99],
            ['name' => 'Product 12', 'price' => 112.99],
            ['name' => 'Product 13', 'price' => 602.99],
            ['name' => 'Product 14', 'price' => 129.99],
            ['name' => 'Product 15', 'price' => 1200.99],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }


    }
}
