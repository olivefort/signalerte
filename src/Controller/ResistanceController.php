<?php

namespace App\Controller;

use App\Entity\Resistance;
use App\Form\ResistanceType;
use App\Repository\ResistanceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ResistanceController extends AbstractController
{
     // READ
     #[Route('/resistance', name: 'resistance.index', methods:['GET'])]
     public function index( 
        ResistanceRepository $repository,
         PaginatorInterface $paginator,
         Request $request
     ): Response {
         $resistances = $paginator->paginate(
             $repository->findAll(),
             $request->query->getInt('page', 1), 10
         );        
         return $this->render('pages/resistance/index.html.twig', [
             'resistances' => $resistances
         ]);        
     }
 
     // CREATE
     #[Route('/resistance/nouveau', name: 'resistance.new', methods:['GET', 'POST'])]
     public function new( 
         Request $request,
         EntityManagerInterface $manager
     ): Response {
         $resistance = new Resistance();
         $form = $this->createForm(ResistanceType::class, $resistance);
 
         $form->handleRequest($request);
         if($form->isSubmitted() && $form->isValid()){
             $resistance = $form->getData();
 
             $manager->persist($resistance);
             $manager->flush();
 
             $this->addFlash(
                 'success',
                 'Votre resistance a été ajouté avec succès !'
             );
 
             return $this->redirectToRoute('resistance.index');
         }
 
         return $this->render('pages/resistance/new.html.twig',[
             'form' => $form->createView()
         ]);
     }
 
     //UPDATE
     #[Route('/resistance/edition/{id}', name: 'resistance.edit', methods:['GET', 'POST'])]
     public function edit(
         Request $request,
         Resistance $resistance,
         EntityManagerInterface $manager,
     ): Response {
         $form = $this->createForm(ResistanceType::class, $resistance);
 
         $form->handleRequest($request);
         if($form->isSubmitted() && $form->isValid()){
             $resistance = $form->getData();
 
             $manager->persist($resistance);
             $manager->flush();
 
             $this->addFlash(
                 'success',
                 'Votre resistance a été modifié avec succès !'
             );
 
             return $this->redirectToRoute('resistance.index');
         }
         return $this->render('pages/resistance/edit.html.twig',[
             'form' => $form->createView()
         ]);
     }
 
     //DELETE
     #[Route('/resistance/suppression/{id}', name: 'resistance.delete', methods:['GET'])]
     public function delete(
         EntityManagerInterface $manager,
         Resistance $resistance
     ): Response {
         $manager->remove($resistance);
         $manager->flush();
 
         $this->addFlash(
             'success',
             'Votre resistance a été supprimé avec succès !'
         );
 
         return $this->redirectToRoute('resistance.index');
     }
}

