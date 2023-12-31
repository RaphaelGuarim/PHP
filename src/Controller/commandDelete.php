<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 * @var int $id
 */

use Entity\Command;
use Symfony\Component\HttpFoundation\RedirectResponse;

$commandRepository = $entityManager->getRepository(Command::class);
$command = $commandRepository->find($id);

$entityManager->remove($command);
$entityManager->flush();

return new RedirectResponse('/command');