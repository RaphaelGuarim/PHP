<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 * @var Request $request
 * @var int $id
 * @var ValidatorInterface $validator
 */

use Entity\Cart;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

$cartRepository = $entityManager->getRepository(Cart::class);
$cart = $cartRepository->find($id);

$arrayViolations = [];

if (Request::METHOD_POST == $request->getMethod()) {
    $cart
        ->setQuantity($request->get('quantity'));

    $violations = $validator->validate($cart);

    if ($violations->count() == 0) {
        $entityManager->persist($cart);
        $entityManager->flush();

        return new RedirectResponse('/cart');
    }
    foreach ($violations as $violation) {
        $arrayViolations[$violation->getPropertyPath()][] = $violation->getMessage();
    }
}

return new Response($twig->render('cart/edit.html.twig', ['cart' => $cart, 'violations' => $arrayViolations]));