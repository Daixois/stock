<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
   
    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils, MovieRepository $movieRepository): Response
    {
        // dd($this->getUser());
        if ($this->getUser() !== null) {
            return $this->redirectToRoute('movie_liste');
        }
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        
        $lastMovie = $movieRepository->findBy([], ['created_at' => 'DESC'], 3);
        

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'lastMovie' => $lastMovie,
        ]);

    }

   
    #[Route('/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}