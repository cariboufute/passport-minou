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
        'client_id' => 7,
        'redirect_uri' => 'http://minou.test/callback',
        'response_type' => 'code',
        'scope' => '',
        'state' => $state,
    ]);

    return redirect('http://minette.test/oauth/authorize?' . $query);
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
            'client_id' => 7,
            'client_secret' => 'CFgGJPsvu7RBGKY9bKvsEhrEjjVloV9zbrCCIYsE',
            'redirect_uri' => 'http://minou.test/callback',
            'code' => $request->code,
        ],
    ]);

    return json_decode((string)$response->getBody(), true);
});
