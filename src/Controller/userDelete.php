<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 * @var int $id
 */

use Entity\User;
use Symfony\Component\HttpFoundation\RedirectResponse;

$userRepository = $entityManager->getRepository(User::class);
$user = $userRepository->find($id);

$entityManager->remove($user);
$entityManager->flush();

return new RedirectResponse('/user');