<?php

namespace Apsg\Domains\Facades;

use Illuminate\Support\Facades\Facade;

class Domains extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'domains';
    }
}
