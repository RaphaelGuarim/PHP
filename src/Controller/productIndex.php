<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 */


use Entity\Product;
use Symfony\Component\HttpFoundation\Response;

$productRepository = $entityManager->getRepository(Product::class);
$products = $productRepository->findAll(); 

return new Response($twig->render('product/index.html.twig', ['products' => $products]));