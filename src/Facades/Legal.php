<?php

namespace ImmoWert\Legal\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static void routes()
 * @method static array company()
 * @method static string addressLine()
 * @method static bool uses(string $service)
 * @method static string siteName()
 * @method static string viewFor(string $page)
 *
 * @see \ImmoWert\Legal\Legal
 */
class Legal extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \ImmoWert\Legal\Legal::class;
    }
}
