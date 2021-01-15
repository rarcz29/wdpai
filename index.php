<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('signup', 'DefaultController');
Routing::get('home', 'DefaultController');
Routing::get('community', 'DefaultController');
Routing::post('newProject', 'ProjectController');
Routing::post('login', 'SecurityController');
Routing::post('register', 'SecurityController');
Routing::post('gitToolConnect', 'GitToolsController');
Routing::get('getConnectedTools', 'GitToolsController');
Routing::get('projects', 'ProjectRestApiController');
Routing::get('projectsAll', 'ProjectRestApiController');
Routing::get('like', 'ProjectRestApiController');
Routing::get('dislike', 'ProjectRestApiController');
Routing::post('admin', 'AdminController');
Routing::post('comment', 'CommentController');
Routing::get('comments', 'CommentController');
Routing::get('removeComment', 'CommentController');
Routing::get('addJoinRequest', 'JoinRequestController');
Routing::get('joinRequests', 'JoinRequestController');
Routing::get('accept', 'JoinRequestController');
Routing::get('decline', 'JoinRequestController');

Routing::run($path);
