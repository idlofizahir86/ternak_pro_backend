<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ListModels extends Command
{
    protected $signature = 'list:models';
    protected $description = 'List all models in the application';

    public function handle()
    {
        $models = File::allFiles(app_path('Models'));

        foreach ($models as $model) {
            $this->info(basename($model, '.php')); // Menampilkan nama model tanpa ekstensi .php
        }
    }
}
