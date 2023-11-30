<?php

namespace Zymfonix\Modulus\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Zymfonix\Modulus\Manager;
use Zymfonix\Modulus\Module;

class InstallModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:install {module?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Installs modules to the package.json.';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
    }
}
