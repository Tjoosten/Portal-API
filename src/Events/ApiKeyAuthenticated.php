<?php

namespace Leasedeck\PortalApi\Events;

use Illuminate\Http\Request;
use Leasedeck\PortalApi\Models\ApiKey;
use Illuminate\Queue\SerializesModels;

/**
 * Class ApiKeyAuthenticated
 *
 * @package Leasedeck\PortalApi\Events
 */
class ApiKeyAuthenticated
{
    use SerializesModels;

    /** @var Request $request   Variable for the request data.*/
    public $request;

    /** @var ApiKey $apiKey Variable for the Apikey database entity */
    public $apiKey;

    /**
     * Create a new event instance.
     *
     * @param  Request  $request    Mapping variable for the request data.
     * @param  ApiKey   $apiKey     Mapping variable for the ApiKey database entity
     * @return void
     */
    public function __construct(Request $request, ApiKey $apiKey)
    {
        $this->request = $request;
        $this->apiKey  = $apiKey;
    }
}
