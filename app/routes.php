<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

/*
 * Add Route group for API Access
 */
Route::group(array('prefix' => 'api/'), function()
{
    Route::resource('theme', 'ThemesController',
        array(
            'only' => array('store', 'show')
        ));
});

Route::get('/oauth', function()
{
    $consumerKey = $_ENV['TUMBLR_API_CONSUMER_KEY'];
    $consumerSecret = $_ENV['TUMBLR_API_SECRET_KEY'];

    $tmpToken = Session::get('tmp_oauth_token', null);
    $tmpTokenSecret = Session::get('tmp_oauth_token_secret', null);

    $client = new Tumblr\API\Client($consumerKey, $consumerSecret, $tmpToken, $tmpTokenSecret);

    // Change the base url
    $requestHandler = $client->getRequestHandler();
    $requestHandler->setBaseUrl('https://www.tumblr.com/');

    if (Input::has('oauth_verifier'))
    {
        // exchange the verifier for the keys
        $verifier = trim(Input::get('oauth_verifier'));
        $resp = $requestHandler->request('POST', 'oauth/access_token', array('oauth_verifier' => $verifier));
        $out = (string) $resp->body;
        $data = array();
        parse_str($out, $data);

        Session::forget('tmp_oauth_token');
        Session::forget('tmp_oauth_token_secret');

        Session::put('Tumblr_oauth_token', $data['oauth_token']);
        Session::put('Tumblr_oauth_token_secret', $data['oauth_token_secret']);
    }


    if ( ! Session::has('Tumblr_oauth_token') || ! Session::has('Tumblr_oauth_token_secret'))
    {
        // start the old gal up
        $callbackUrl = 'http://localhost:8000/oauth';

        $resp = $requestHandler->request('POST', 'oauth/request_token', array(
                'oauth_callback' => $callbackUrl
            ));

        // Get the result
        $result = (string)$resp->body;
        parse_str($result, $keys);

        Session::put('tmp_oauth_token', $keys['oauth_token']);
        Session::put('tmp_oauth_token_secret', $keys['oauth_token_secret']);

        $url = 'https://www.tumblr.com/oauth/authorize?oauth_token=' . $keys['oauth_token'];

        return Redirect::to($url);
    }

    $client = new Tumblr\API\Client(
        $consumerKey,
        $consumerSecret,
        Session::get('Tumblr_oauth_token'),
        Session::get('Tumblr_oauth_token_secret')
    );

    $info = $client->getUserInfo();

    return View::make('oauth_success');
});

App::missing(function($exception)
{
    App::abort(404);
    // !TODO: custom 404 page
    // return Response::view('errors.missing', array(), 404);
});