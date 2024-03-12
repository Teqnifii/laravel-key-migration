<?php

namespace Teqnifii\LaravelKeyMigration\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

use function Laravel\Prompts\confirm;
use function Laravel\Prompts\progress;
use function Laravel\Prompts\warning;

class KeyMigrate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'key:migrate {--job : Run the migration as a job on the queue.} {--vendor : Include any models from the vendors in the migration.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate columns that are encrypted from the old key to the new key.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if ($this->option('job')) {
            foreach ($this->getAllModels() as $model) {

            }
        } else {
            $models = $this->getAllModels();
            if (count($models) > 1) {
                warning('You are about to migrate a large number of models. This could take a long time to complete.');
                $confirm = confirm('Continue?', default: false, hint: 'Recommended to run as a job on a queue for large number of models.');
                if (! $confirm) {
                    return;
                }
            }

            /**
             * @var Model[] $models
             * @var Model $model
             */
            foreach ($models as $model) {
                $migrate = false;
                $columns = [];
                $modelClass = new $model;
                foreach ($modelClass->getCasts() as $column => $cast) {
                    if ($cast === 'encrypted') {
                        $migrate = true;
                        $columns[] = $column;
                    }
                }
                if ($migrate) {
                    $this->info('Migrating '.$model.' columns: '.implode(', ', $columns));
                    $progress = progress('Migrating '.$model.' columns: '.implode(', ', $columns).'...', $model::count());
                    $model::chunk(100, function ($models) use ($columns, $progress) {
                        foreach ($models as $model) {
                            foreach ($columns as $column) {
                                // This is since there was some bugs randomly where pulling the model would not reset the encrypted value with the new key.
                                // Don't know why, but this seems to fix it.
                                $model->{$column} = $model->{$column};
                                $model->save();
                                $progress->advance();
                            }
                        }
                    });
                    $progress->finish();
                }
            }
        }
    }

    protected function getAllModels(): array
    {
        $models = [];
        if ($this->option('vendor')) {
            $modelsPath = base_path();
            $suffix = '';
        } else {
            $modelsPath = base_path('app/Models');
            $suffix = 'app/Models/';
        }
        $modelFiles = File::allFiles($modelsPath);
        $modelFiles = array_filter($modelFiles, function ($file) {
            return $file->getExtension() === 'php';
        });
        foreach ($modelFiles as $modelFile) {
            $class = str_replace(['app/', '/', '.php'], ['App/', '\\', ''], $suffix.$modelFile->getRelativePathname());
            if (class_exists($class)) {
                if (is_subclass_of($class, 'Illuminate\Database\Eloquent\Model')) {
                    $models[] = $class;
                }
            }
        }

        return $models;
    }
}
