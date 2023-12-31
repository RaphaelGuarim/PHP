<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 * @var Request $request
 * @var int $id
 * @var ValidatorInterface $validator
 */

use Entity\User;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

$userRepository = $entityManager->getRepository(User::class);
$user = $userRepository->find($id);

$arrayViolations = [];

if (Request::METHOD_POST == $request->getMethod()) {
    $hash = hash('sha256', $request->get('password'));
    $user
        ->setName($request->get('name'))
        ->setEmail($request->get('email'))
        ->setPassword($hash);

    $violations = $validator->validate($user);

    if ($violations->count() == 0) {
        $entityManager->persist($user);
        $entityManager->flush();

        return new RedirectResponse('/user');
    }
    foreach ($violations as $violation) {
        $arrayViolations[$violation->getPropertyPath()][] = $violation->getMessage();
    }
}

return new Response($twig->render('user/edit.html.twig', ['user' => $user, 'violations' => $arrayViolations]));