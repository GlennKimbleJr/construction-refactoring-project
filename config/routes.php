<?php 

$route->get('/[index]', 'HomeController@index');

$route->resource('projects');
$route->get('/projects/{id:number}/complete', 'ProjectsController@complete');
$route->post('/projects/{id:number}/complete', 'ProjectsController@completed');
$route->get('/projects/{id:number}/calllog', 'ProjectsController@calllog');

$route->get('/projects/{id:number}/categories', 'ProjectsController@selectCat');
$route->get('/projects/{id:number}/categories/{category_id:number}/bidders', 'ProjectsController@selectBid');
$route->post('/projects/{id:number}/bidders', 'ProjectsController@addBid');

$route->post('/bidders/{id:number}/status', 'BiddersController@setStatus');
$route->get('/bidders/{id:number}/winner[/]', 'BiddersController@winner');
$route->post('/bidders/{id:number}/winner', 'BiddersController@setWinner');
$route->get('/bidders/{id:number}/rate[/]', 'BiddersController@rate');
$route->post('/bidders/{id:number}/rate', 'BiddersController@setRating');

$route->resource('contacts');

$route->resource('superintendents');

$route->resource('categories');

$route->resource('zones');

$route->resource('reports');
$route->resource('reports/bids', 'Reports\BidderParticipationController');
$route->resource('reports/score', 'Reports\BidderSatisfactionController');
