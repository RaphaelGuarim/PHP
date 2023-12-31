<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 * @var int $id
 */

use Entity\Cart;
use Symfony\Component\HttpFoundation\RedirectResponse;

$cartRepository = $entityManager->getRepository(Cart::class);
$cart = $cartRepository->find($id);

$entityManager->remove($cart);
$entityManager->flush();

return new RedirectResponse('/cart');