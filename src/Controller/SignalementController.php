<?php

namespace App\Controller;

use App\Entity\Signalement;
use App\Form\SignalementType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\SignalementRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class SignalementController extends AbstractController
{
    //READ
    #[Route('/signalement', name: 'signalement.index', methods:['GET'])]
    public function index(
        SignalementRepository $repository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $signalements = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page',1), 20
        );
        return $this->render('pages/signalement/index.html.twig', [
            'signalements' => $signalements
        ]);
    }

    //CREATE
    #[Route('/signalement/nouveau', name:'signalement.new', methods:['GET','POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $manager
    ): Response {
        $signalement = new Signalement();
        $form = $this->createForm(SignalementType::class, $signalement);

        $form->HandleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $signalement = $form->getData();
            $manager->persist($signalement);
            $manager->flush();
            $this->addFlash(
                'success',
                'Votre signalement a été ajouté avec succès !'
            );
            return $this->redirectToRoute('signalement.index');
        }
        return $this->render('pages/signalement/new.html.twig',[
            'form'=> $form->createView()
        ]);
    }

    //UPDATE
    #[Route('/signalement/edition/{id}', name:'signalement.edit', methods: ['GET','POST'])]
    public function edit(
        Request $request,
        EntityManagerInterface $manager,
        Signalement $signalement
    ): Response {
        $form = $this->createForm(SignalementType::class, $signalement);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $signalement = $form->getData();

            $manager->persist($signalement);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre signalement a été modifié avec succès!'
            );
            return $this->redirectToRoute('signalement.index');
        }
        return $this->render('pages/signalement/edit.html.twig',[
            'form' => $form->createView()
        ]);
    }

    //DELETE
    #[Route('/signalement/suppresion/{id}', name: 'signalement.delete', methods: ['GET'])]
    public function delete(
        EntityManagerInterface $manager,
        Signalement $signalement
    ): Response {
        $manager->remove($signalement);
        $manager->flush();
    
        $this->addFlash(
            'success',
            'Votre signalement a été supprimé avec succès !'
        );
        return $this->redirectToRoute('signalement.index');
    }

    //SHOW
    #[Route('/signalement/{id}', name: 'signalement.show', methods: ['GET','POST'])]
    public function show(
        Signalement $signalement,
        Request $request,
        SignalementRepository $repository,
        PaginatorInterface $paginator,        
        EntityManagerInterface $manager
    ) :Response {
        return $this->render('pages/signalement/show.html.twig', [
            'signalement' => $signalement
        ]);
    }
}
