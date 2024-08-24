<?php

namespace TechEd\SimplOtp\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class PublishFrontend extends Command
{
    protected $signature = 'simplotp:publish-frontend';

    protected $description = 'Publish the SimplOtp frontend Blade views';

    public function handle()
    {
        $this->publishBladeViews();
        
        $this->info('SimplOtp frontend Blade views published successfully.');
    }

    protected function publishBladeViews()
    {
        $source = __DIR__.'/../resources/views';
        $destination = resource_path('views/vendor/simplotp');

        if (!File::isDirectory($destination)) {
            File::makeDirectory($destination, 0755, true);
        }

        File::copyDirectory($source, $destination);
    }
}