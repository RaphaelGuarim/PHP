<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 * @var Request $request
 * @var ValidatorInterface $validator
 */

use Entity\Product;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

$productRepository = $entityManager->getRepository(Product::class);

$arrayViolations = [];

if (Request::METHOD_POST == $request->getMethod()) {
    $product = (new Product())
        ->setName($request->get('name'))
        ->setPhoto($request->get('photo'))
        ->setWeight($request->get('weight'))
        ->setPrice($request->get('price'));

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

return new Response($twig->render('product/new.html.twig', ['violations' => $arrayViolations]));