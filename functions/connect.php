<?php

require '../vendor/autoload.php';

error_reporting(E_ALL);

$date = date("Y-m-d"); 

$db = new App\Database('mysql:host=localhost;dbname=construction;', 'homestead', 'secret');
