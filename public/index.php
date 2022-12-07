<?php
require_once "../vendor/autoload.php";

use Dotenv\Dotenv;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

session_start();
$dotenv = Dotenv::createImmutable(__DIR__."/..");
$dotenv->safeLoad();
$loader = new FilesystemLoader('../views');
$twig = new Environment($loader);

$dispatcher = FastRoute\simpleDispatcher
(
    function(FastRoute\RouteCollector $routes)
    {
        $routes->addRoute('GET', '/', ['App\Controllers\ArticleController', 'index']);
        $routes->addRoute('GET', '/signup', ["\App\Controllers\RegistrationController", 'index']);
        $routes->addRoute('GET', '/registerConfirmation', ["\App\Controllers\RegistrationController", 'registrationConfirm']);
        $routes->addRoute('POST', '/register', ["\App\Controllers\RegistrationController", 'register']);
        $routes->addRoute('GET', '/loginForm', ['App\Controllers\LoginController', 'loginForm']);
        $routes->addRoute('POST', '/login', ['App\Controllers\LoginController', 'login']);
        $routes->addRoute('GET', '/logout', ['App\Controllers\LoginController', 'logout']);
        $routes->addRoute('GET', '/changeForm', ['App\Controllers\AccountController', 'changeForm']);
        $routes->addRoute('POST', '/change', ['App\Controllers\AccountController', 'change']);
        $routes->addRoute('GET', '/changeConfirm', ['App\Controllers\AccountController', 'changeConfirm']);
    }
);

$authVars = [
    \App\ViewVariables\AuthViewVariables::class
];

foreach ($authVars as $var) {
    $var = new $var;
    $twig->addGlobal($var->getName(), $var->getValue());
}

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

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
            if (! empty($_SESSION["errors"]))
            {
                $twig->addGlobal("validationErrors",$_SESSION["errors"]);
            }
            if (! empty($_SESSION["validInputs"]))
            {
                $twig->addGlobal("validInputs",$_SESSION["validInputs"]);
            }
            echo $twig->render($response->getPath(), $response->getParams());
            unset($_SESSION["errors"]);
            unset($_SESSION["validInputs"]);
        }

        break;
}







