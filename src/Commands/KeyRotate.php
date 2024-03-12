<?php

namespace Teqnifii\LaravelKeyMigration\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class KeyRotate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'key:rotate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rotate the app key out for a new one.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (! File::exists(base_path('.env'))) {
            $this->error('The .env file does not exist.');

            return 1;
        }
        $this->info('Rotating the app key...');
        $currentKey = config('app.key');
        $this->addToPreviousKeys($currentKey);
        $this->call('key:generate');
    }

    protected function addToPreviousKeys($key)
    {
        $env = File::get(base_path('.env'));
        if (str_contains($env, 'APP_PREVIOUS_KEYS')) {
            $env = preg_replace('/APP_PREVIOUS_KEYS=(.*)/', 'APP_PREVIOUS_KEYS=$1,'.$key, $env);
        } else {
            $env = preg_replace('/APP_KEY=(.*)/', 'APP_KEY=$1'.PHP_EOL.'APP_PREVIOUS_KEYS='.$key, $env);
        }
        File::put(base_path('.env'), $env);
        $this->info('App key added to previous keys.');
    }
}
