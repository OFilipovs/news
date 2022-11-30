<?php
use Dotenv\Dotenv;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once "../vendor/autoload.php";

$dotenv = Dotenv::createImmutable(__DIR__."/..");
$dotenv->safeLoad();
$loader = new FilesystemLoader('../views');
$twig = new Environment($loader);


$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $routes) {
    $routes->addRoute('GET', '/', ['App\Controllers\ArticleController', 'index']);
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        [$controller, $method] = $handler;
        $response = (new $controller)->{$method}();

        if ($response instanceof \App\Template){
            echo $twig->render($response->getPath(), $response->getParams());
        }

        break;
}






