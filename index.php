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
            ->withJson(array(
              'response' => 'Route not found'));

    };
};

$app = new \Slim\App($handler);

$app->add(function ($request, $response, $next) {

	$response = $next($request, $response);
	return $response->withHeader('Content-Type', 'application/json')
  ->withHeader('Access-Control-Allow-Origin', '*')
  ->withHeader('Access-Control-Allow-Headers', array('Content-Type', 'X-Requested-With', 'Authorization'))
  ->withHeader('Access-Control-Allow-Methods', array('GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'));

});

$app->get('/', function($request, $response) {

  return $response->withJson(array(
    'response' => 'Welcome to our API!'
  ));

});

$app->get('/get/{name}', function($request, $response, $args) {

   return $response->withJson($args['name']);

});

$app->post('/signup', function($request, $response, $args) {

  $data = $request->getParsedBody();
  return $response->withJson(signup_student($data));

});

$app->post('/selection', function ($request, $response, $args){

  $data = $request->getParsedBody();
  return $response->withJson(giveAnswer($data));

});

$app->get('/questions/{type}/all', function($request, $response, $args) {

  return $response->withJson(getQuestions($args['type']));

});



$app->run();
