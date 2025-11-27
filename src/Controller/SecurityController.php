<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

final class SecurityController extends AbstractController
{
    #[Route('/connexion', name: 'security.login', methods:['GET','POST'])]
    public function login(
        AuthenticationUtils $authUtils
    ): Response {       
        return $this->render('pages/security/login.html.twig', [
            'last_username' => $authUtils->getLastUsername(),
            'error' => $authUtils->getLastAuthenticationError()
        ]);
    }

    #[Route('/deconnexion', name: 'security.logout')]
    public function logout(): Response
    {
        // nothing
    }

    #[Route('/inscription', name: 'security.registration', methods:['GET','POST'])]
    public function registration(
        Request $request,
        EntityManagerInterface $manager
    ): Response
    {
        $user = new User();
        $user   ->setRoles(["ROLE_USER"]);                
        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();
            
            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre inscription est validé!'
            );

            return $this->redirectToRoute('home.index');

        }

        return $this->render('pages/security/registration.html.twig', [
            'form' => $form
        ]);
    }

}
