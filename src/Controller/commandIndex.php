<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 */


use Entity\Command;
use Symfony\Component\HttpFoundation\Response;

$commandRepository = $entityManager->getRepository(Command::class);
$commands = $commandRepository->findAll();

return new Response($twig->render('command/index.html.twig', ['commands' => $commands]));