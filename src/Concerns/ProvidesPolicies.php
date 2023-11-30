<?php

namespace Zymfonix\Modulus\Concerns;

use Illuminate\Support\Facades\Gate;

trait ProvidesPolicies
{
    /**
     * Policies to register.
     *
     * @var array
     */
    protected $policies = [];

    /**
     * Register policies.
     */
    protected function registerPolicies()
    {
        if ($this->policies) {
            foreach ($this->policies as $key => $value) {
                Gate::policy($key, $value);
            }
        }
    }
}
