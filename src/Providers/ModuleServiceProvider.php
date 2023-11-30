<?php

namespace Zymfonix\Modulus\Providers;

use Illuminate\Support\ServiceProvider;
use TorMorten\Eventy\Facades\Eventy;
use Zymfonix\Modulus\Concerns\ProvidesConfigs;
use Zymfonix\Modulus\Facades\Modulus;

class ModuleServiceProvider extends ServiceProvider
{
    use ProvidesConfigs;

    /**
     * The module instance.
     *
     * @var Module
     */
    protected $module;

    /**
     * The directory of the module.
     *
     * @var string
     */
    protected $dir;

    /**
     * The namespace of the module.
     *
     * @var string
     */
    protected $namespace;

    public function __construct($app)
    {
        parent::__construct($app);

        $this->dir = str_replace(['src', 'Providers'], '', dirname($this->getReflection()->getFileName()));
        $this->namespace = $this->findNamespace();
        $this->module = Modulus::register(basename($this->dir), $this->namespace, $this->dir);
    }

    public function register()
    {
        $this->beforeRegister();

        foreach ($this->getTraits($this->getReflection()) as $traitName => $trait) {
            $registerMethod = 'register'.class_basename($traitName);
            if (method_exists($this, $registerMethod)) {
                $this->{$registerMethod}();
            }
        }

        $this->registerModule();

        $this->afterRegister();
    }

    public function boot()
    {
        $this->beforeBoot();

        foreach ($this->getTraits($this->getReflection()) as $traitName => $trait) {
            $bootMethod = 'boot'.class_basename($traitName);
            if (method_exists($this, $bootMethod)) {
                $this->{$bootMethod}();
            }
        }

        $this->bootModule();

        Eventy::action("module.boot.{$this->module->getId()}");

        $this->afterBoot();
    }

    protected function getTraits(\ReflectionClass $reflection, array $traits = []): array
    {
        if ($reflection->getParentClass()) {
            $traits = $this->getTraits($reflection->getParentClass(), $traits);
        }

        if (! empty($reflection->getTraits())) {
            foreach ($reflection->getTraits() as $trait_key => $trait) {
                $traits[$trait_key] = $trait;
                $traits = $this->getTraits($trait, $traits);
            }
        }

        return $traits;
    }

    /**
     * Returns the namespace of the current class.
     *
     * @return string
     *
     * @throws \ReflectionException
     */
    protected function findNamespace()
    {
        return $this->getReflection()->getNamespaceName();
    }

    /**
     * Get the reflection of this class.
     *
     * @return \ReflectionClass
     *
     * @throws \ReflectionException
     */
    protected function getReflection()
    {
        return new \ReflectionClass($this);
    }

    public function beforeBoot()
    {
        //
    }

    public function bootModule()
    {
        //
    }

    public function afterBoot()
    {
        //
    }

    public function beforeRegister()
    {
        //
    }

    public function registerModule()
    {
        //
    }

    public function afterRegister()
    {
        //
    }
}
