<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 */


use Entity\User;
use Symfony\Component\HttpFoundation\Response;

$userRepository = $entityManager->getRepository(User::class);
$users = $userRepository->findAll();

return new Response($twig->render('user/index.html.twig', ['users' => $users]));