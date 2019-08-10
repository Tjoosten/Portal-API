<?php

namespace Leasedeck\PortalApi\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Interface KeyFactory
 *
 * @package Leasedeck\PortalApi\Contracts
 */
interface KeyFactory
{
    /**
     * Polymorphic instance for the api keys.
     *
     * @return MorphTo
     */
    public function apikeyable(): MorphTo;

    /**
     * method for making and storing a new API key in the application.
     *
     * @param  mixed  $apikeyable  The database entity that needs to be attached to the key.
     * @param  string $serviceName The name of the application that is using the API key.
     * @return KeyFactory
     */
    public function make($apikeyable, string $serviceName = 'Onbekende service'): self;

    /**
     * Sure method to generate aa unique API key.
     *
     * @return string
     */
    public static function generateKey(): string;

    /**
     * Checks whether a key exists in the database or not
     *
     * @param  string $key The key that needs to be checked.
     * @return bool
     */
    private static function keyExists(string $key): bool;
}
