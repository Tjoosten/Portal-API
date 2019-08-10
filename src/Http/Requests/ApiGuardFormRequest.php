<?php

namespace Leasedeck\PortalApi\Http\Requests;

use EllipseSynergie\ApiResponse\Laravel\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use League\Fractal\Manager;

/**
 * Class ApiGuardFormRequest
 *
 * @package Leasedeck\PortalApi\Http\Requests
 */
class ApiGuardFormRequest extends FormRequest
{
    /**
     * Register method of the output expects to be JSON or not.
     *
     * @return bool
     */
    public function expectsJson(): bool
    {
        return true;
    }

    /**
     * Override method for formatting the errors.
     *
     * @param  Validator $validator The main request validator contract.
     * @return array
     */
    protected function formatErrors(Validator $validator): array
    {
        return $validator->getMessageBag()->toArray();
    }

    /**
     * Output for the form validation error response.
     *
     * @param  array $errors Array of the validation errors.
     * @return Response
     */
    public function response(array $errors): Response
    {
        $response = new Response(new Manager());
        return $response->errorUnprocessable($errors);
    }
}
