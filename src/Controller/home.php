<?php

/** @var Twig\Environment $twig 
 *  @var SessionInterface $_SESSION
 *  @var Doctrine\ORM\EntityManager $entityManager
*/

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Entity\User;

session_start();

$user = $entityManager->getRepository(User::class)->find($_SESSION['id']);

return new Response($twig->render('home/home.html.twig',['user' => $user]));