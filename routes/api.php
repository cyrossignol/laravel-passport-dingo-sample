<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {

    // Copy and paste the 'axios' statements into the browser's JavaScript
    // console to make API calls.

    // This endpoint should successfully respond when logged out.
    //
    // Note that this endpoint doesn't account for the CSRF token state. If you
    // send this while logged in and get stuck, call "axios.post('logout')" and
    // log back in.
    //
    // axios.get('/api/guest').then(response => console.log(response));
    $api->get('guest', function (Request $request) {
        return [
            'endpoint' => 'guest',
            'user' => $request->user(),
        ];
    });

    // These endpoints should respond with 'unauthenticated' until the user
    // logs in. Then, we should see information about the authenticated user.
    $api->group([ 'middleware' => 'auth:api-combined' ], function ($api) {

        // axios.get('/api/get').then(response => console.log(response));
        $api->get('get', function (Request $request) {
            return [
                'endpoint' => 'get',
                'user' => $request->user(),
            ];
        });

        // axios.post('/api/post').then(response => console.log(response));
        $api->post('post', function (Request $request) {
            return [
                'endpoint' => 'post',
                'user' => $request->user(),
            ];
        });

        // axios.get('/api/internal-get').then(response => console.log(response));
        $api->get('internal-get', function (Request $request) {
            return [
                'endpoint' => 'internal-get',
                'user' => $request->user(),
                'internal' => app('Dingo\Api\Dispatcher')->get('get'),
            ];
        });

        // axios.post('/api/internal-post').then(response => console.log(response));
        $api->post('internal-post', function (Request $request) {
            return [
                'endpoint' => 'internal-post',
                'user' => $request->user(),
                'internal' => app('Dingo\Api\Dispatcher')->post('post'),
            ];
        });

    });

});
