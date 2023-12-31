<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 * @var SessionInterface $_SESSION
 */


use Entity\Cart;
use Entity\Product;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

session_start();
$cartRepository = $entityManager->getRepository(Cart::class);
$carts = $cartRepository->findBy(['user_id' => $_SESSION['id']]);

$productRepository = $entityManager->getRepository(Product::class);
$products = $productRepository->findAll();


return new Response($twig->render('cart/index.html.twig', ['carts' => $carts, 'products' => $products]));