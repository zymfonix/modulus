<?php

namespace Zymfonix\Modulus\Concerns;

trait ProvidesMiddleware
{
    /**
     * Global middleware to register.
     *
     * @var array
     */
    protected $globalMiddleware = [];

    /**
     * Middleware groups to register.
     *
     * @var array
     */
    protected $middlewareGroups = [];

    /**
     * Middleware alias to register.
     *
     * @var array
     */
    protected $routeMiddleware = [];

    /**
     * Loads middlewares.
     */
    protected function bootProvidesMiddleware()
    {
        $this->loadGlobalMiddlewares();
        $this->loadMiddlewareGroups();
        $this->loadRouteMiddleware();
    }

    /**
     * Register global middleware.
     */
    protected function loadGlobalMiddlewares()
    {
        $kernel = $this->app->make('Illuminate\Contracts\Http\Kernel');

        foreach ($this->globalMiddleware as $middleware) {
            $kernel->pushMiddleware($middleware);
        }
    }

    /**
     * Register middleware groups.
     */
    protected function loadMiddlewareGroups()
    {
        if (empty($this->middlewareGroups)) {
            return;
        }

        foreach ($this->middlewareGroups as $group => $middlewares) {
            foreach ($middlewares as $middleware) {
                $this->app['router']->pushMiddlewareToGroup($group, $middleware);
            }
        }
    }

    /**
     * Register middleware aliases.
     */
    protected function loadRouteMiddleware()
    {
        if (empty($this->routeMiddleware)) {
            return;
        }

        foreach ($this->routeMiddleware as $key => $middleware) {
            $this->app['router']->aliasMiddleware($key, $middleware);
        }
    }
}
