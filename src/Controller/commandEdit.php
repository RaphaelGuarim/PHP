<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 * @var Request $request
 * @var int $id
 * @var ValidatorInterface $validator
 */

use Entity\Command;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

$commandRepository = $entityManager->getRepository(Command::class);
$command = $commandRepository->find($id);

$arrayViolations = [];

if (Request::METHOD_POST == $request->getMethod()) {
    $command
        ->setAdress($request->get('adress'));

    $violations = $validator->validate($command);

    if ($violations->count() == 0) {
        $entityManager->persist($command);
        $entityManager->flush();

        return new RedirectResponse('/command');
    }
    foreach ($violations as $violation) {
        $arrayViolations[$violation->getPropertyPath()][] = $violation->getMessage();
    }
}

return new Response($twig->render('command/edit.html.twig', ['command' => $command, 'violations' => $arrayViolations]));