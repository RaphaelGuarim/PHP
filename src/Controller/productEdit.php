<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 * @var Request $request
 * @var int $id
 * @var ValidatorInterface $validator
 */

use Entity\Product;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

$productRepository = $entityManager->getRepository(Product::class);
$product = $productRepository->find($id);

$arrayViolations = [];

if (Request::METHOD_POST == $request->getMethod()) {
    $product
        ->setName($request->get('name'))
        ->setPhoto($request->get('photo'))
        ->setPrice($request->get('price'))
        ->setWeight($request->get('weight'));

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

return new Response($twig->render('product/edit.html.twig', ['product' => $product, 'violations' => $arrayViolations]));