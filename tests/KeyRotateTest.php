<?php

use Illuminate\Support\Facades\File;

it('can run with existing .env', function () {
    File::put(base_path('.env'), File::get(base_path('.env.example')));
    $this->artisan('key:rotate')
        ->expectsOutputToContain('Rotating the app key...')
        ->expectsOutputToContain('App key added to previous keys.')
        ->expectsOutputToContain('Application key set successfully.')
        ->assertExitCode(0);
});

it('fails to run without .env', function () {
    File::delete(base_path('.env'));
    $this->artisan('key:rotate')
        ->expectsOutput('The .env file does not exist.')
        ->assertExitCode(1);
});
