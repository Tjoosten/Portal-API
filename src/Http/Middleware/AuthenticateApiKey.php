<?php

namespace Leasedeck\PortalApi\Http\Middleware;

use App\Models\User;
use Illuminate\Http\Request;
use Closure;
use Illuminate\Http\Response;
use Leasedeck\PortalApi\Events\ApiKeyAuthenticated;

/**
 * Class AuthenticateAPiKey
 *
 * @package Leasedeck\PortalApi\Http\Middleware
 */
class AuthenticateApiKey
{
    /**
     * Handle an incoming request
     *
     * @param Request     $request  Instance for the request data.
     * @param Closure     $next     Closure to proceed the request.
     * @param string|null $guard    The name of the authentication guard.
     * @return mixed
     */
    public function handle($request, Closure $next, ?string $guard = null)
    {
        $apiKeyValue = $request->header('X-Authorization');
        $apiKey = User::where('key', $apiKeyValue)->first();

        if (empty($apiKey)) {
            return $this->unauthorizedResponse();
        }

        // Update this api key's last_used-at and last_ip_address
        $apiKey->update(['laast_gebruikt_op' => now(), 'laatste_ip_address' => $request->ip()]);
        $apikeyable = $apiKey->apikeyable;

        // Bind the user or object to the request
        // By doing thi, we can now get the specified entity trough the request object in the controller using;
        $request->setUserResolver(static function () use ($apikeyable) {
            return $apikeyable;
        });

        // Attach the apikey object to the request
        $request->apiKey = $apiKey;
        event(new ApiKeyAuthenticated($request, $apiKey));

        return $next($request);
    }

    /**
     * The unauthorized API response
     *
     * @return array
     */
    protected function unauthorizedResponse(): array
    {
        return response([
            'error' => [
                'code'      => '401',
                'http_code' => 'GEN-UNAUTHORIZED',
                'message'   => 'Unauthorized.',
            ],
        ], Response::HTTP_FORBIDDEN);
    }
}
