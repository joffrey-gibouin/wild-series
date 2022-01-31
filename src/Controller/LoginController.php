<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    /**
     * @Route("/security", name="security")
     */
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        // get the security error if there is one
                 $error = $authenticationUtils->getLastAuthenticationError();

                 // last username entered by the user
                 $lastUsername = $authenticationUtils->getLastUsername();

          return $this->render('security/index.html.twig', [
                           'last_username' => $lastUsername,
                           'error'         => $error,
          ]);
    }
}
