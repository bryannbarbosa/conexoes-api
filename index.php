<?php

require 'vendor/autoload.php';
require 'database/env.php';
require 'models/autoload.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$handler = new \Slim\Container();

$handler['notFoundHandler'] = function ($handler) {
    return function ($request, $response) use ($handler) {

        return $handler['response']
            ->withStatus(404)
            ->withHeader('Content-Type', 'application/json')
            ->withJson(array('Route not found'));

    };
};

$app = new \Slim\App($handler);

$app->add(function ($request, $response, $next) {

	$response = $next($request, $response);
	return $response->withHeader('Content-Type', 'application/json');

});

$app->get('/', function($request, $response) {

  global $DB;

  $data = $DB->select("users", [
	"id",
	"name"
	]);

  return $response->withJson($data);

});

$app->get('/get/{name}', function($request, $response, $args) {

   return $response->withJson($args['name']);

});

$app->post('/signup', function($request, $response, $args) {

  $data = $request->getParsedBody();
  return $response->withJson(signup($data));

});

$app->run();
