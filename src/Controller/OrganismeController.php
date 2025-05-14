<?php

namespace App\Controller;

use App\Entity\Organisme;
use App\Form\OrganismeType;
use App\Repository\OrganismeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class OrganismeController extends AbstractController
{
     //READ
     #[Route('/organisme', name: 'organisme.index', methods:['GET'])]
     public function index( 
         OrganismeRepository $repository,
         PaginatorInterface $paginator,
         Request $request
     ): Response {
         $organismes = $paginator->paginate(
             $repository->findAll(),
             $request->query->getInt('page', 1), 10
         );        
         return $this->render('pages/organisme/index.html.twig', [
             'organismes' => $organismes
         ]);        
     }
 
     // CREATE
     #[Route('/organisme/nouveau', name: 'organisme.new', methods:['GET', 'POST'])]
     public function new( 
         Request $request,
         EntityManagerInterface $manager
     ): Response {
         $organisme = new Organisme();
         $form = $this->createForm(OrganismeType::class, $organisme);
 
         $form->handleRequest($request);
         if($form->isSubmitted() && $form->isValid()){
             $organisme = $form->getData();
 
             $manager->persist($organisme);
             $manager->flush();
 
             $this->addFlash(
                 'success',
                 'Votre organisme a été ajouté avec succès !'
             );
 
             return $this->redirectToRoute('organisme.index');
         }
 
         return $this->render('pages/organisme/new.html.twig',[
             'form' => $form->createView()
         ]);
     }
 
     //UPDATE
     #[Route('/organisme/edition/{id}', name: 'organisme.edit', methods:['GET', 'POST'])]
     public function edit(
         Request $request,
         Organisme $organisme,
         EntityManagerInterface $manager,
     ): Response {
         $form = $this->createForm(OrganismeType::class, $organisme);
 
         $form->handleRequest($request);
         if($form->isSubmitted() && $form->isValid()){
             $organisme = $form->getData();
 
             $manager->persist($organisme);
             $manager->flush();
 
             $this->addFlash(
                 'success',
                 'Votre organisme a été modifié avec succès !'
             );
 
             return $this->redirectToRoute('organisme.index');
         }
         return $this->render('pages/organisme/edit.html.twig',[
             'form' => $form->createView()
         ]);
     }
 
     //DELETE
     #[Route('/organisme/suppression/{id}', name: 'organisme.delete', methods:['GET'])]
     public function delete(
         EntityManagerInterface $manager,
         Organisme $organisme
     ): Response {
         $manager->remove($organisme);
         $manager->flush();
 
         $this->addFlash(
             'success',
             'Votre organisme a été supprimé avec succès !'
         );
 
         return $this->redirectToRoute('organisme.index');
     }
}
