<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
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
        
        // $lastMovie = $movieRepository->findBy([], ['created_at' => 'DESC'], 3);
        

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            // 'lastMovie' => $lastMovie,
        ]);

    }

   
    #[Route('/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

// Voir pour réinitialiser le mdp ou changer si oubli.
// voir avec mailer.

//     #[Route('/oubli-pass', name: 'app_forgotten_password')]
//     public function forgottenPass(Request $request, UserRepository $users, MailerInterface $mailer, TokenGeneratorInterface $tokenGenerator, ManagerRegistry $doctrine
//     ): Response
//     {
    
//     $form = $this->createForm(ResetPassType::class);

//     $form->handleRequest($request);

//     if ($form->isSubmitted() && $form->isValid()) {
        
//         $donnees = $form->getData();

//         $user = $users->findOneByEmail($donnees['email']);

//         if ($user === null) {
            
//             $this->addFlash('danger', 'Cette adresse e-mail est inconnue');
            
//             return $this->redirectToRoute('app_login');
//         }

//         $token = $tokenGenerator->generateToken();

//         try{
//             $user->setResetToken($token);
//             $entityManager = $doctrine->getManager();
//             $entityManager->persist($user);
//             $entityManager->flush();
//         } catch (\Exception $e) {
//             $this->addFlash('warning', $e->getMessage());
//             return $this->redirectToRoute('app_login');
//         }

//         $url = $this->generateUrl('app_reset_password', array('token' => $token), UrlGeneratorInterface::ABSOLUTE_URL);

//         $email = (new Email())
//         ->from('test@test.com')
//         ->to($user->getEmail())
//         //->cc('cc@example.com')
//         //->bcc('bcc@example.com')
//         //->replyTo('fabien@example.com')
//         //->priority(Email::PRIORITY_HIGH)
//         ->subject('Time for Symfony Mailer!')
//         ->text('Sending emails is fun again!')
//         ->html("Bonjour,<br><br>Afin de réinitialiser votre mot de passe, veuillez copier-coller le lien suivant : " . $url,
//         'text/html'
//     )
// ;

//     $mailer->send($email);

//         $this->addFlash('message', 'E-mail de réinitialisation du mot de passe envoyé !');

//         return $this->redirectToRoute('app_login');
//     }

//     return $this->render('security/forgotten_password.html.twig',[
//         'emailForm' => $form->createView()]);
// }


// #[Route('/reset_pass/{token}', name: 'app_reset_password')]
// public function resetPassword(Request $request, string $token, UserPasswordHasherInterface $passwordEncoder)
// {
    
//     // $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['reset_token' => $token]);
//     $user = $this->getUser();
//     if ($user === null) {
        
//         $this->addFlash('danger', 'Token Inconnu');
//         return $this->redirectToRoute('app_login');
//     }

//     if ($request->isMethod('POST')) {
        
//         $user->setResetToken(null);

//         $user->setPassword($passwordEncoder->hashPassword($user, $request->request->get('password')));

//         $entityManager = $this->getDoctrine()->getManager();
//         $entityManager->persist($user);
//         $entityManager->flush();

//         $this->addFlash('message', 'Mot de passe mis à jour');

//         return $this->redirectToRoute('app_login');
//     }else {
        
//         return $this->render('security/reset_password.html.twig', [
//             'token' => $token]);
//     }

// }
}