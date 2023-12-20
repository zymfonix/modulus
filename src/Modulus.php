<?php

namespace Zymfonix\Modulus;

use Illuminate\Support\Collection;

class Modulus extends Collection
{
    public static $packages = null;

    public function register($id, $namespace, $directory): Module
    {
        $module = new Module(
            $id,
            $namespace,
            $directory
        );

        $this->put($id, $module);

        return $module;
    }

    public function get($key, $default = null)
    {
        if (!parent::get($key)) {
            return new Module('dummy', 'Dummy', __DIR__);
        }

        return parent::get($key, $default); // TODO: Change the autogenerated stub
    }

    public function current()
    {

    }

    public function instance()
    {
        return $this;
    }

    public function getPackages()
    {
        if (!static::$packages) {
            static::$packages = new Collection(
                json_decode(file_get_contents(base_path('vendor/composer/installed.json')), true)['packages']
            );
        }

        return static::$packages;
    }
}
