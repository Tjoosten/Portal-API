<?php

namespace Leasedeck\PortalApi\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Leasedeck\PortalApi\Models\ApiKey;
use App\Models\User;

/**
 * Trait Apikeyable
 *
 * @package Leasedeck\PortalApi\Traits
 */
trait ApiKeyable
{
    /**
     * Data relation for the API keys.
     *
     * user model is not in package because it is some file from the main portal.
     *
     * @return MorphMany
     */
    public function apikeys(): MorphMany
    {
        return $this->morphMany(User::class, ApiKey::class, 'apikeyable');
    }

    /**
     * Shortcut method for creating API key programmatically.
     *
     * @return ApiKey
     */
    public function createApiKey(): ApiKey
    {
        return ApiKey::make($this);
    }
}
