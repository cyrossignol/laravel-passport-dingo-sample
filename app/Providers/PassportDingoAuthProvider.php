<?php

namespace App\Providers;

use Dingo\Api\Contract\Auth\Provider;
use Dingo\Api\Routing\Route;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

/**
 * A custom Dingo auth provider that bridges Passport's authentication by
 * simply reusing the User authenticated by Passport.
 *
 * @link https://github.com/dingo/api/wiki/Authentication
 */
class PassportDingoAuthProvider implements Provider
{
    /**
     * The instance of the Passport TokenGuard that handles authentication
     * for API requests.
     *
     * @var Illuminate\Contracts\Auth\Guard
     */
    protected $guard;

    /**
     * Create a new instance using the Guard implementation configured for
     * Passport.
     *
     * @param AuthManager $auth Used to fetch the Passport Guard
     */
    public function __construct(AuthManager $auth)
    {
        // This should match the name of the "guard" set in config/auth.php
        // for API requests that uses the "passport" driver:
        $this->guard = $auth->guard('api');
    }

    /**
     * Authenticate the User making a request.
     *
     * This implementation deliberately uses Passport's auth Guard, but we
     * could also check "$request->user()" to rely on whichever authentication
     * mechanism the application uses at the time.
     *
     * @param Request $request The current HTTP request information
     * @param Route   $route   The API route to authenticate a user for
     *
     * @return App\User The authenticated User (as resolved by Passport)
     *
     * @throws UnauthorizedHttpException For unauthorized access (because
     * no User was authenticated by Passport)
     */
    public function authenticate(Request $request, Route $route)
    {
        if ($this->guard->check()) {
            return $this->guard->user();
        }

        throw new UnauthorizedHttpException('Not authenticated via Passport.');
    }
}
