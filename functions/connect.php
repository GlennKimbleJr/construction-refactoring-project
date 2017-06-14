<?php

require '../vendor/autoload.php';

error_reporting(E_ALL);

$date = date("Y-m-d"); 

$connection = mysql_connect('localhost', 'homestead', 'secret');
if (! $connection) {
    die("Database Connection Failed" . mysql_error());
}

$select_db = mysql_select_db('construction');
if (! $select_db) {
    die("Database Selection Failed" . mysql_error());
}

$db = new App\Database('mysql:host=localhost;dbname=construction;', 'homestead', 'secret');
