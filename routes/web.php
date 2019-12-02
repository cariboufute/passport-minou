<?php

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/redirect', function (Request $request) {
    $state = Str::random(40);
    $request->session()->put('state', $state);

    $query = http_build_query([
        'client_id' => 3,
        'redirect_uri' => 'http://minou.test/callback',
        'response_type' => 'code',
        'scope' => '',
        'state' => $state,
    ]);

    //$laravelTokenCookie = $request->cookie('laravel_token');

    return redirect('http://minette.test/oauth/authorize?' . $query);//->withCookie($laravelTokenCookie);
});

Route::get('/callback', function (Request $request) {
    $state = $request->session()->pull('state');

    throw_unless(
        strlen($state) > 0 && $state === $request->state,
        InvalidArgumentException::class
    );

    $http = new Client;

    $response = $http->post('http://minette.test/oauth/token', [
        'form_params' => [
            'grant_type' => 'authorization_code',
            'client_id' => 3,
            'client_secret' => env('MINETTE_CLIENT_SECRET'),
            'redirect_uri' => 'http://minou.test/callback',
            'code' => $request->code,
        ],
    ]);

    $tokens = json_decode((string)$response->getBody(), true);

    $request->session()->put('access_token', $tokens['access_token']);
    $request->session()->put('refresh_token', $tokens['refresh_token']);

    return $tokens;
});

function getMinetteResponse(string $relation, Request $request) {
    $http = new Client;

    $response = $http->get('http://minette.test/api/' . $relation, [
        'headers' => [
            'Authorization' => 'Bearer ' . $request->user()->personal_access_token
        ]
    ]);

    return (string) $response->getBody();
}

Route::get('sex', function (Request $request) {
    return getMinetteResponse('sex', $request);
});

Route::get('love', function (Request $request) {
    return getMinetteResponse('love', $request);
});




