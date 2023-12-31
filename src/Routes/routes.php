<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

$routes->add('home', new Route('/home'));
$routes->add('signin', new Route('/signin'));
$routes->add('login', new Route('/'));
$routes->add('hello', new Route('/hello/{name}', ['name' => 'World']));
$routes->add('fibonacci', new Route('/fibonacci/{nb}', ['nb' => 10], ['nb' => '^[1-9][0-9]*$']));
$routes->add('userIndex', new Route('/user'));
$routes->add('userNew', new Route('/user/new'));
$routes->add('userShow', new Route('/user/{id}', [], ['id' => ('\d+')]));
$routes->add('userEdit', new Route('/user/{id}/edit', [], ['id' => ('\d+')]));
$routes->add('userDelete', new Route('/user/{id}/delete', [], ['id' => ('\d+')]));
$routes->add('productIndex', new Route('/product'));
$routes->add('productNew', new Route('/product/new'));
$routes->add('productShow', new Route('/product/{id}', [], ['id' => ('\d+')]));
$routes->add('productEdit', new Route('/product/{id}/edit', [], ['id' => ('\d+')]));
$routes->add('productDelete', new Route('/product/{id}/delete', [], ['id' => ('\d+')]));
$routes->add('cartIndex', new Route('/cart'));
$routes->add('cartShow', new Route('/cart/{id}', [], ['id' => ('\d+')]));
$routes->add('cartEdit', new Route('/cart/{id}/edit', [], ['id' => ('\d+')]));
$routes->add('cartNew', new Route('/cart/new/{id}', [], ['id' => ('\d+')]));
$routes->add('cartDelete', new Route('/cart/{id}/delete', [], ['id' => ('\d+')]));
$routes->add('commandIndex', new Route('/command'));
$routes->add('commandShow', new Route('/command/{id}', [], ['id' => ('\d+')]));
$routes->add('commandNew', new Route('/command/new/{id}', [], ['id' => ('\d+')]));
$routes->add('connect', new Route('/connect'));

return $routes;