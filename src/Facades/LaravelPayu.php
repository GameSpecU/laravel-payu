<?php

namespace Gamespecu\LaravelPayu\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelPayu extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-payu';
    }
}
