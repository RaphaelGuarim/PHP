<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 * @var int $id
 */

use Entity\Cart;
use Symfony\Component\HttpFoundation\Response;

$cartRepository = $entityManager->getRepository(Cart::class);
$cart = $cartRepository->find($id);

return new Response($twig->render('cart/show.html.twig', ['cart' => $cart]));