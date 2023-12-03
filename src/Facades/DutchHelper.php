<?php

namespace ItsOnlyJeff\DutchHelpers\Facades;

use Illuminate\Support\Facades\Facade;

class DutchHelper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'DutchHelper';
    }
}