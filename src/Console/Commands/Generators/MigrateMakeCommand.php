<?php

namespace Zymfonix\Modulus\Console\Commands\Generators;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Zymfonix\Modulus\Concerns\ModuleCommand;
use Zymfonix\Modulus\Manager;

class MigrateMakeCommand extends \Illuminate\Database\Console\Migrations\MigrateMakeCommand
{
    use ModuleCommand;

    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'module:make:migration {name : The name of the migration}
        {module : The name of the module}
        {--create= : The table to be created}
        {--table= : The table to migrate}';

    /**
     * Write the migration file to disk.
     *
     * @param string $name
     * @param string $table
     * @param bool $create
     * @return string
     */
    protected function writeMigration($name, $table, $create)
    {
        $file = pathinfo($this->creator->create(
            $name, $this->getMigrationPath(), $table, $create
        ), PATHINFO_FILENAME);

        $this->line("<info>Created Migration:</info> {$file}");
    }

    /**
     * Get migration path (either specified by '--path' option or default location).
     *
     * @return string
     */
    protected function getMigrationPath()
    {
        return $this->getBasePath() . '/database/migrations';
    }
}
