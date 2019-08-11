<?php

namespace Leasedeck\PortalApi\Controller;

use EllipseSynergie\ApiResponse\Laravel\Response;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use League\Fractal\Manager;

/**
 * Class BaseController
 *
 * @package Leasedeck\PortalApi\Controller
 */
class BaseController extends Controller
{
    /** @var Response $response The form output instance*/
    protected $response;

    /**
     * BaseController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $request = new Request();
        $fractal = new Manager();

        if (isset($request->include)) {
            $fractal->parseIncludes($request->include);
        }

        $this->response = new Response($fractal);
    }
}
