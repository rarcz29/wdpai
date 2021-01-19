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
Routing::get('projects', 'ProjectController');
Routing::get('projectsAll', 'ProjectController');
Routing::get('like', 'ProjectController');
Routing::get('dislike', 'ProjectController');
Routing::post('admin', 'AdminController');
Routing::post('comment', 'CommentController');
Routing::get('comments', 'CommentController');
Routing::get('removeComment', 'CommentController');
Routing::get('addJoinRequest', 'JoinRequestController');
Routing::get('joinRequests', 'JoinRequestController');
Routing::get('accept', 'JoinRequestController');
Routing::get('decline', 'JoinRequestController');
Routing::post('searchTechnologies', 'ProjectController');
Routing::post('search', 'ProjectController');

Routing::run($path);
