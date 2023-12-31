<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 * @var Request $request
 * @var ValidatorInterface $validator
 * @var SessionInterface $_SESSION
 */

use Entity\Cart;
use Entity\Product;
use Entity\User;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

$CartRepository = $entityManager->getRepository(Cart::class);

$arrayViolations = [];

if (Request::METHOD_POST == $request->getMethod()) {
    session_start();
    $quantity = (int)$request->get('quantity');

    $productRepository = $entityManager->getRepository(Product::class);
    $products = $productRepository->findAll(); 
    $product_id = $entityManager->getRepository(Product::class)->find($id);
    $user_id = $entityManager->getRepository(User::class)->find($_SESSION['id']);
    $pro = $productRepository->find($id);


    $product = (new Cart())
        ->setProductId($product_id)
        ->setQuantity($quantity)
        ->setWeight($quantity*$pro->getWeight())
        ->setPrice($quantity*$pro->getPrice())
        ->setUserId($user_id);

    $violations = $validator->validate($product);

    if ($violations->count() == 0) {
        $entityManager->persist($product);
        $entityManager->flush();

        return new RedirectResponse('/product');
    }
    foreach ($violations as $violation) {
        $arrayViolations[$violation->getPropertyPath()][] = $violation->getMessage();
    }
}

