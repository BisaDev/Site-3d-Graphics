<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/**
 * Class AuthController
 * @package App\Http\Controllers\Api\Auth
 */
class AuthController extends Controller
{
    /**
     * @var object
     */
    private $client;

    /**
     * DefaultController constructor.
     */
    public function __construct()
    {
        //@todo set .env var with the custom client
        $this->client = DB::table('oauth_clients')->where('id', 1)->first();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    protected function authenticate(Request $request)
    {
        $request->request->add([
            'username' => $request->username,
            'password' => $request->password,
            'grant_type' => 'password',
            'client_id' => $this->client->id,
            'client_secret' => $this->client->secret,
            'scope' => '*',
        ]);

        $proxy = Request::create(
            'oauth/token',
            'POST'
        );

        return Route::dispatch($proxy);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    protected function refreshToken(Request $request)
    {
        $request->request->add([
            'grant_type' => 'refresh_token',
            'refresh_token' => $request->refresh_token,
            'client_id' => $this->client->id,
            'client_secret' => $this->client->secret,
        ]);

        $proxy = Request::create(
            '/oauth/token',
            'POST'
        );

        return Route::dispatch($proxy);
    }
}
