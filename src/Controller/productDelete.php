<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 * @var int $id
 */

use Entity\Product;
use Symfony\Component\HttpFoundation\RedirectResponse;

$productRepository = $entityManager->getRepository(Product::class);
$product = $productRepository->find($id);

$entityManager->remove($product);
$entityManager->flush();

return new RedirectResponse('/product');