<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 * @var Request $request
 * @var ValidatorInterface $validator
 */

use Entity\User;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

$userRepository = $entityManager->getRepository(User::class);

$arrayViolations = [];

if (Request::METHOD_POST == $request->getMethod()) {
    $hash = hash('sha256', $request->get('password'));
    $user = (new User())
        ->setName($request->get('name'))
        ->setEmail($request->get('email'))
        ->setPassword($hash);

    $violations = $validator->validate($user);

    if ($violations->count() == 0) {
        $entityManager->persist($user);
        $entityManager->flush();

        return new RedirectResponse('/');
    }
    foreach ($violations as $violation) {
        $arrayViolations[$violation->getPropertyPath()][] = $violation->getMessage();
    }
}

return new Response($twig->render('login/signin.html.twig', ['violations' => $arrayViolations]));