<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 * @var int $id
 */

use Entity\Product;
use Symfony\Component\HttpFoundation\Response;

$productRepository = $entityManager->getRepository(Product::class);
$product = $productRepository->find($id);

return new Response($twig->render('product/show.html.twig', ['product' => $product]));