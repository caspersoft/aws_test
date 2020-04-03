<?php
namespace App;

require __DIR__ . '/vendor/autoload.php';

use Router\{Router, Request};
use App\{App, CalendController};

session_start();

define('INDEX_PATH', __DIR__);
define('APP_PATH', __DIR__.'/src/');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$router = new Router(new Request);



$router->get('/', function($request) {
    $c = new CalendController($request);

    if ( $request->getQuery('id') ) $c->view();
    else                            $c->index();
});

$router->get('/login', function($request) {
    $c = new AuthController($request);
    $c->login();
});

$router->post('/login', function($request) {
    $c = new AuthController($request);
    $c->login();
});

$router->get('/register', function($request) {
    $c = new AuthController($request);
    $c->register();
});

$router->post('/register', function($request) {
    $c = new AuthController($request);
    $c->register();
});

$router->get('/logout', function($request) {
    $c = new AuthController($request);
    $c->logout();
});

$router->post('/done', function($request) use ($app) {
    $c = new CalendController($request);
    $c->done();
});

$router->post('/distribute', function($request) use ($app) {
    $c = new CalendController($request);
    $c->distribute();
});

$router->post('/upload', function($request) use ($app) {
    $c = new CalendController($request);
    $c->upload();
});