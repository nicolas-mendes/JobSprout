<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = Tag::factory(20)->create();

        $jobs = Job::factory(150)->create(new Sequence(
            ['featured' => false],
            ['featured' => true]
        ));

        foreach ($jobs as $job) {
            $job->tags()->attach(
                $tags->random(rand(1, 8))->pluck('id')
            );
        }
    }
}
