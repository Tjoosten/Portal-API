<?php

use Leasedeck\PortalApi\Http\Middleware\AuthenticateApiKey;

return [

    /**
     * --------------------------------------------------------------------------
     * Voyager Api Route Middleware
     * --------------------------------------------------------------------------
     *
     * These middleware will be assigned to every Telescope route, giving you
     * the chance to add your own middleware to this list or change any of
     * the existing middleware. Or, you can simply stick with this list.
     *
     */

    'middleware' => ['api', AuthenticateApiKey::class],

];
