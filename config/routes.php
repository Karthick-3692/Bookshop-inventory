<?php
use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

return static function (RouteBuilder $routes) {
    $routes->connect('/', ['controller' => 'Users', 'action' => 'login']);
$routes->connect('/user/books', ['controller' => 'Users', 'action' => 'searchBooks']);

    $routes->scope('/', function (RouteBuilder $builder) {
        $builder->connect('/login', ['controller' => 'Users', 'action' => 'login']);
        $builder->connect('/register', ['controller' => 'Users', 'action' => 'register']);
        $builder->connect('/pos', ['controller' => 'Sales', 'action' => 'create']);
        $builder->connect('/invoice/*', ['controller' => 'Sales', 'action' => 'invoice']);
        $builder->connect('/sales', ['controller' => 'Sales', 'action' => 'index']);
        $builder->connect('/sales/view/*', ['controller' => 'Sales', 'action' => 'view']);
        $builder->connect('/reports/sales', ['controller' => 'Reports', 'action' => 'salesReport']);
        $builder->connect('/reports/purchase', ['controller' => 'Reports', 'action' => 'purchaseReport']);
        

        $builder->fallbacks(DashedRoute::class);
    });
};
