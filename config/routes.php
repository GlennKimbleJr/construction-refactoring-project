<?php

$auth = new App\Middleware\Auth;

$route->get('/dashboard', 'HomeController@index')->middleware($auth);

$route->resource('projects')->middleware($auth);
$route->get('/projects/{id:number}/complete', 'ProjectsController@complete')->middleware($auth);
$route->post('/projects/{id:number}/complete', 'ProjectsController@completed')->middleware($auth);
$route->get('/projects/{id:number}/calllog', 'ProjectsController@calllog')->middleware($auth);

$route->get('/projects/{id:number}/categories', 'ProjectsController@selectCat')->middleware($auth);
$route->get('/projects/{id:number}/categories/{category_id:number}/bidders', 'ProjectsController@selectBid')->middleware($auth);
$route->post('/projects/{id:number}/bidders', 'ProjectsController@addBid')->middleware($auth);

$route->post('/bidders/{id:number}/status', 'BiddersController@setStatus')->middleware($auth);
$route->get('/bidders/{id:number}/winner[/]', 'BiddersController@winner')->middleware($auth);
$route->post('/bidders/{id:number}/winner', 'BiddersController@setWinner')->middleware($auth);
$route->get('/bidders/{id:number}/rate[/]', 'BiddersController@rate')->middleware($auth);
$route->post('/bidders/{id:number}/rate', 'BiddersController@setRating')->middleware($auth);

$route->resource('contacts')->middleware($auth);
$route->get('/contacts/categories[/]', 'ContactsController@selectCategory')->middleware($auth);
$route->get('/contacts/categories/{category_id:number}[/]', 'ContactsController@category')->middleware($auth);

$route->resource('superintendents')->middleware($auth);

$route->get('reports', 'ReportsController@index')->middleware($auth);
$route->get('reports/bids', 'Reports\BidderParticipationController@index')->middleware($auth);
$route->get('reports/score', 'Reports\BidderSatisfactionController@index')->middleware($auth);

$route->get('auth/login', 'Auth\LoginController@index');
$route->post('auth/login', 'Auth\LoginController@store');
$route->get('auth/logout', 'Auth\LogoutController@index');
