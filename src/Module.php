<?php

namespace Zymfonix\Modulus;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

class Module
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $namespace;

    /**
     * @var string
     */
    protected $directory;

    /**
     * Module constructor.
     * @param $id
     * @param $namespace
     * @param $directory
     */
    public function __construct($id, $namespace, $directory)
    {
        $this->id = str_replace(['-module', '-tool'], '', $id);
        $this->namespace = $namespace;
        $this->directory = $directory;
    }

    /**
     * Checks if the module has web routes defined.
     * @return bool
     */
    public function hasWebRoutes()
    {
        return file_exists($this->directory . '/routes/web.php');
    }

    /**
     * Checks if the module has api routes defined.
     * @return bool
     */
    public function hasApiRoutes()
    {
        return file_exists($this->directory . '/routes/api.php');
    }

    /**
     * Checks if the module is active in the current request.
     * @return bool
     */
    public function isActiveInRequest()
    {
        return $this->getRoutes()
                ->filter(function ($route) {
                    return str_start(request()->getRequestUri(), '/') === str_start($route, '/');
                })->count() > 0;
    }

    /**
     * Creates a collection of all routes attached to this model.
     * @return Collection
     * @throws \Exception
     */
    public function getRoutes()
    {
        return (new Collection(Route::getRoutes()->getRoutes()))->filter(function ($route) {
            return starts_with($route->getName(), $this->getWebRouteName());
        })->map(function ($route) {
            return $route->uri;
        })->values();
    }

    /**
     * Gets the namespace.
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * Gets the ID.
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Gets the directory path.
     * @return string
     */
    public function getDirectory()
    {
        return $this->directory;
    }

    /**
     * Gets the module config.
     * @return mixed
     * @throws \Exception
     */
    public function getConfig($key = null, $default = null)
    {
        $search = [
            $this->id,
        ];

        if ($key) $search[] = $key;

        return config(join('.', $search), $default);
    }

    /**
     * Gets the controller namespace.
     * @return string
     */
    public function getWebControllersNamespace()
    {
        return $this->getNamespace() . '\Http\Controllers';
    }

    /**
     * Gets the API controller namespace.
     * @return string
     */
    public function getApiControllersNamespace()
    {
        return $this->getNamespace() . '\Http\Controllers\Api';
    }

    /**
     * Gets the name prefix.
     * @return string
     */
    public function getWebRouteName()
    {
        return $this->getId() . '::';
    }

    /**
     * Gets the api name prefix.
     * @return string
     */
    public function getApiRouteName()
    {
        return $this->getId() . '::api.';
    }

    public function getPath($path = '')
    {
        return $this->getDirectory() . '/' . $path;
    }

    public static function mix($path, $module, $cdn = false)
    {
        if (App::runningInConsole() || App::runningUnitTests()) {
            return $path;
        }

        return (new Support\Mix($path, $module, $cdn))->toString();
    }
}
