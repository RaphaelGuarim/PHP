<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 * @var int $id
 */

use Entity\User;
use Symfony\Component\HttpFoundation\Response;

$userRepository = $entityManager->getRepository(User::class);
$user = $userRepository->find($id);

return new Response($twig->render('user/show.html.twig', ['user' => $user]));