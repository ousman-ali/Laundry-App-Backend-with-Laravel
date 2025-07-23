<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class GeneratePermissionsFromRoutes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permissions:generate-from-routes';
    protected $description = 'Generate permissions from named routes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $routes = Route::getRoutes();

        $count = 0;
        foreach ($routes as $route) {
            $name = $route->getName();

            if ($name && !Permission::where('name', $name)->exists()) {
                Permission::create(['name' => $name]);
                $this->info("Permission created: $name");
                $count++;
            }
        }

        $this->info("✅ Total $count permissions generated.");
        return 0;
    }
}
