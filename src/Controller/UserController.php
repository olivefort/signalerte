<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Upload;
use App\Form\UserType;
// use Symfony\Component\HttpKernel\Profiler\Profiler;
// use Symfony\Component\ExpressionLanguage\Expression;
use League\Csv\Reader;
use App\Form\ImportType;
use Doctrine\ORM\EntityManagerInterface;
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
    
    // private $em;
    
    // public function __construct(
    //     EntityManagerInterface $em)
    // {
    //     parent::__construct();
    //     $this->em = $em;
    // }

    // #[Route('/signalement', name: 'signalement.index', methods:['GET', 'POST'])]
    // public function upload(
    //     Request $request,
    //     EntityManagerInterface $manager
    //     //  #[Autowire('%kernel.project_dir%/public/uploads/users')] string $fileDirectory
    // ) : Response {
    //         $upload = new Upload();
    //         $formUser = $this->createForm(ImportType::class, $upload);
    //         $formUser->handleRequest($request);
    //         if ($formUser->isSubmitted() && $formUser->isValid()) {

    //             $file = $upload -> getCsvFile();
    //             $fileName = md5(uniqid()).'.'.$file->guessExtension();
    //             $file->move($this->getParameter('csvFile', $fileName));
    //             $upload->setCsvFile($fileName);

    //             $csv = Reader::createFromPath('%kernel.root.dir%/../public/uploads/'.$fileName);
    //             $csv->setHeaderOffset(0);
    //             $csv->setDelimiter(';');
    //             $csv->setEscape('');
    //             $records = $csv->getRecords();
    //             foreach ($records as $record){ 
    //                 $user = (new User())
    //                     ->setNom($record['nom'])
    //                     ->setPrenom($record['prenom'])
    //                     ->setEmail($record['email'])              
    //                     ->setPlainPassword($record['password'])
    //                 ;
    //                 $this->em->persist($user);
    //             }
    //             $this->em->flush();
    //             $this->addFlash('success','Bien ajouté avec succès');
    //             return $this->redirectToRoute('signalement.index');
    //         }
    //         return $this->render('pages/signalement/index.html.twig', [
    //             'formUser' => $formUser,
    //         ]);
    // }


   
        


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
}

