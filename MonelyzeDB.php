<?php

namespace Illuminate\Support\Facades;

use Illuminate\Support\Facades\Facade;

class MonelyzeDB extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'monelyzeDB';
    }
}
?>