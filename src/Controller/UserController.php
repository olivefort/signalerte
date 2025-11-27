<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
// use Symfony\Component\HttpKernel\Profiler\Profiler;
// use Symfony\Component\ExpressionLanguage\Expression;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class UserController extends AbstractController
{
    // #[IsGranted(new Expression ("is_granted('ROLE_USER') and user === subject"), subject:'logedUser',)]
    #[Route('/utilisateur/edition/{id}', name: 'user.edit', methods: ['GET', 'POST'])]
    public function edit(
        User $user,
        Request $request,
        EntityManagerInterface $manager,
        // UserPasswordHasherInterface $hasher,
        // Profiler $profiler
    ): Response {        
        if (!$this->getUser()){
            return $this->redirectToRoute('security.login');
        }        
               
        if ($this->getUser() !== $user){
            return $this->redirectToRoute('home.index');
        }
        
        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);
        
        // if ($logedUser !== $this->getUser()){
        //     throw $this->createAccessDeniedException();
        // }else{
        if ($form->isSubmitted() && $form->isValid()){
        //         if($hasher->isPasswordValid($logedUser, $form->getData()->getPlainPassword())){
            $user = $form->getData();
            $manager->persist($user);
            $manager->flush();              

            $this->addFlash(
                'success',
                'Votre compte à bien été modifié !'
            );                
            return $this->redirectToRoute('signalement.index');
        }else{
            $this->addFlash(
                'warning',
                'Mot de passe incorrect !'
            );         
        }

        return $this->render('pages/user/edit.html.twig', [
            'form'=>$form,
        ]);
    }
}
        


    // #[IsGranted(new Expression ("is_granted('ROLE_USER') and user === subject"), subject:'logedUser',)]
    // #[Route('/utilisateur/edition-mot-de-passe/{id}', name: 'user.edit.password', methods: ['GET', 'POST'])]
    // public function editPassword(
    //     User $logedUser,
    //     Request $request,
    //     UserPasswordHasherInterface $hasher,
    //     EntityManagerInterface $manager
    // ) : Response 
    // {
    //     if(!$this->getUser()){
    //         return $this->redirectToRoute('security.login');
    //     }

    //     if($this->getUser() !==  $logedUser){
    //         return $this->redirectToRoute('recipe.index');
    //     }
        
    //     $form = $this->createForm(UserType::class);

    //     $form->handleRequest($request);
    //     if ($logedUser !== $this->getUser()) {
    //         throw $this->createAccessDeniedException();        
    //     }else{
    //         if ($form->isSubmitted() && $form->isValid()){
    //             if($hasher->isPasswordValid( $logedUser, $form->getData()['plainPassword'])){
    //                 // Solution 1 (commenter la partie preUpdate dans le UserListener)
    //                 $logedUser->setPassword(
    //                     $hasher->hashPassword(
    //                         $logedUser,
    //                         $form->getData()['newPassword']
    //                     )
    //                 );
    //                 //Solution 2 (avec la colonne $updatedAt dans l'Entity User)
    //                 // $logedUser->setUpdatedAt(new \DateTimeImmutable());
    //                 // $logedUser->setPlainPassword(
    //                 //     $form->getData()['newPassword']
    //                 // );

    //                 $manager->persist( $logedUser);
    //                 $manager->flush();

    //                 $this->addFlash(
    //                     'success',
    //                     'Votre mot de passe à bien été modifié !'
    //                 );                
    //                 return $this->redirectToRoute('recipe.index');
    //             }else{
    //                 $this->addFlash(
    //                     'warning',
    //                     'Mot de passe incorrect !'
    //                 );   
    //             }
    //         }
    //     }
    //     return $this->render('pages/user/edit.html.twig', [
    //         'form' => $form->createView()
    //     ]);
    // }

