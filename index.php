<?php 

// this file handles routing

$routes = [
	"/" 		=> "app.php",
	"/api" 		=> "api.php",
	"/register" => "register.php"
];

function abort($err) {
	http_response_code($err);

	echo "Sorry, there was an error!";

	die();
}

$uri = parse_url($_SERVER['REQUEST_URI']);
$path = $uri['path'];
$query = $uri['query'];

if (array_key_exists($path, $routes)) {
	require_once($routes[$path]);
} else {
	abort(404);
}


