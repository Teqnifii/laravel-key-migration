<?php

namespace Workbench\Database\Seeders;

use Illuminate\Database\Seeder;
use Workbench\App\Models\Folder\Folder2\Test3;
use Workbench\App\Models\Folder\Test2;
use Workbench\App\Models\Test;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Test::factory()->count(10)->create();
        Test2::factory()->count(10)->create();
        Test3::factory()->count(10)->create();
    }
}
