<?php

namespace Slexx\AssetsManager\Laravel;

use Illuminate\Support\Facades\Facade;

class Assets extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'assets';
    }
}
