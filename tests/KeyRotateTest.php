<?php

it('can run with existing .env', function () {
    \Illuminate\Support\Facades\File::copy('.env.example', '.env');
    $this->artisan('key:rotate')
        ->expectsOutput('Application key set successfully.')
        ->assertExitCode(0);
});

it('fails to run without .env', function () {
    $this->artisan('key:rotate')
        ->expectsOutput('The .env file does not exist.')
        ->assertExitCode(1);
});
