<?php

namespace App\Controller;

use App\Entity\Infection;
use App\Form\InfectionType;
use App\Repository\InfectionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class InfectionController extends AbstractController
{
    //READ
    #[Route('/infection', name: 'infection.index', methods:['GET'])]
    public function index(
        InfectionRepository $repository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $infections = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1), 10
        );
        return $this->render('pages/infection/index.html.twig', [
            'infections' => $infections
        ]);
    }

    // CREATE
    #[Route('/infection/nouveau', name: 'infection.new', methods:['GET', 'POST'])]
    public function new( 
        Request $request,
        EntityManagerInterface $manager
    ): Response {
        $infection = new Infection();
        $form = $this->createForm(InfectionType::class, $infection);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $infection = $form->getData();

            $manager->persist($infection);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre infection a été ajouté avec succès !'
            );

            return $this->redirectToRoute('infection.index');
        }

        return $this->render('pages/infection/new.html.twig',[
            'form' => $form->createView()
        ]);        
    }

    //UPDATE
    #[Route('/infection/edition/{id}', name: 'infection.edit', methods:['GET', 'POST'])]
    public function edit(
        Request $request,
        Infection $infection,
        EntityManagerInterface $manager,
    ): Response {
        $form = $this->createForm(InfectionType::class, $infection);
 
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $infection = $form->getData();

            $manager->persist($infection);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre infection a été modifié avec succès !'
            );

            return $this->redirectToRoute('infection.index');
        }
        return $this->render('pages/infection/edit.html.twig',[
            'form' => $form->createView()
        ]);        
    }

    //DELETE
    #[Route('/infection/suppression/{id}', name: 'infection.delete', methods:['GET'])]
    public function delete(
        EntityManagerInterface $manager,
        Infection $infection
    ): Response {
        $manager->remove($infection);
        $manager->flush();

        $this->addFlash(
            'success',
            'Votre infection a été supprimé avec succès !'
        );

        return $this->redirectToRoute('infection.index');        
    }
}
