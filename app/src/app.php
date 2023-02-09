<?php
use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();
$routes->add('leap_year', new Routing\Route('/is_leap_year/{year}', [
    'year' => null,
    '_controller' => 'Crimsoncircle\Controller\LeapYearController::index',
]));
$routes->add('conecta_bd', new Routing\Route('/Conectabd/', [
    '_controller' => 'Crimsoncircle\Controller\ConectarbdController::index',
]));

return $routes;

