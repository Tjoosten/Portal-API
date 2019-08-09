<?php

namespace Leasedeck\ApiPortalApi;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Leasedeck\ApiPortalApi\Skeleton\SkeletonClass
 */
class ApiPortalApiFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'api-portal-api';
    }
}
