<?php

use App\Models\Employer;
use App\Models\Job;

it('belongs to a Employer',function(){
    $employer = Employer::factory()->create();
    $job =  Job::factory()->create([
        'employer_id' => $employer->id,
    ]);

    expect($job->employer->is($employer))->toBeTrue();
    
});

it('Can Have Tags', function(){
    $job = Job::factory()->create();

    $job->tag('FrontEnd');

    expect($job->tags)->toHaveCount(1);
});

