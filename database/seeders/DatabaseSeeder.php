<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Customer;
use App\Models\PipelineStage;
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
    }
}
