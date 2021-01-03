<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('signup', 'DefaultController');
Routing::get('home', 'DefaultController');
Routing::get('newProject', 'ProjectController');
Routing::post('login', 'SecurityController');
Routing::post('register', 'SecurityController');
Routing::post('gitToolConnect', 'GitToolsController');
Routing::get('getConnectedTools', 'GitToolsController');
Routing::get('projects', 'api/ProjectRestApiController');

Routing::run($path);
