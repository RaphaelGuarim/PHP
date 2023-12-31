<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 * @var Request $request
 * @var int $id
 * @var ValidatorInterface $validator
 * @var SessionInterface $_SESSION
 */

 use Entity\User;
 use Symfony\Component\HttpFoundation\RedirectResponse;
 use Symfony\Component\HttpFoundation\Request;
 use Symfony\Component\HttpFoundation\Response;
 use Symfony\Component\Validator\Validator\ValidatorInterface;
 use Symfony\Component\HttpFoundation\Session\SessionInterface;

if ($request->isMethod('POST')) {
    session_start();
    // Récupérer les données du formulaire
    $email = $request->request->get('_username');
    $password = $request->request->get('_password');
    $hash = hash('sha256', $password);
    
    $userRepository = $entityManager->getRepository(User::class);
    $users = $userRepository->findAll();

    foreach ($users as $user) {
        if ($user->getPassword()==$hash AND $user->getEmail()==$email ){
            $_SESSION['id'] = $user->getId();
            return new RedirectResponse('/home');
        }
        
    }
}

return new RedirectResponse('/');