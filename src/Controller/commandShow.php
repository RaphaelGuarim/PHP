<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 * @var int $id
 */

use Entity\Command;
use Symfony\Component\HttpFoundation\Response;

$commandRepository = $entityManager->getRepository(Command::class);
$command = $commandRepository->find($id);

return new Response($twig->render('command/show.html.twig', ['command' => $command]));