<?php

namespace Leasedeck\PortalApi\Models;

use Leasedeck\PortalApi\Contracts\Keyfactory;
use Illuminate\Database\Eloquent\{Model, Relations\MorphTo, SoftDeletes};

/**
 * Class ApiKey
 *
 * @package Leasedeck\PortalApi\Models
 */
class ApiKey extends Model implements KeyFactory
{
    use SoftDeletes;

    /**
     * The mass-assignable fields for the database table.
     *
     * @return array
     */
    protected $fillable = ['sleutel', 'apikeyable_id', 'apikeyable_type', 'sleutel', 'laatste_ip_address', 'laatst_gebruikt_op'];

    /**
     * Polymorphic instance for the api key.
     *
     * @return MorphTo
     */
    public function apikeyable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Method for making an storing a new api key in the application.
     * ---
     * Tip: Only use this function in an DB transaction. with a try/catch. for rolling back the changes
     *      When it fails creating a key and the try/catch for better error handling such as logging.
     *
     * @param  mixed  $apikeyable  The database entity that needs to be attached to the key.
     * @param  string $serviceName The name of the application that is using the API key.
     * @return ApiKey
     */
    public static function make($apikeyable, string $serviceName = 'Onbekende service'): self
    {
        return self::create([
            'key'                   => self::generateKey(),
            'service_naam'          => $serviceName,
            'apikeyable_id'         => $apikeyable->id,
            'apikeyable_type'       => get_class($apikeyable),
            'laatste_ip_address'    => request()->ip(),
            'laatst_gebruikt_op'    => now(),
        ]);
    }
}
