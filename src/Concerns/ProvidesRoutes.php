<?php

namespace Zymfonix\Modulus\Concerns;

use Illuminate\Support\Facades\Route;

trait ProvidesRoutes
{
    /**
     * Loads the routes if they exist.
     */
    protected function bootProvidesRoutes()
    {
        if ($this->module->hasWebRoutes()) {
            Route::middleware('web')
                ->name($this->module->getWebRouteName())
                ->namespace($this->module->getWebControllersNamespace())
                ->group($this->dir . '/routes/web.php');
        }

        if ($this->module->hasApiRoutes()) {
            Route::prefix('api')
                ->middleware('api')
                ->name($this->module->getApiRouteName())
                ->namespace($this->module->getApiControllersNamespace())
                ->group($this->dir . '/routes/api.php');
        }
    }

}
