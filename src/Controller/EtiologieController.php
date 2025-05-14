<?php

namespace App\Controller;

use App\Entity\Etiologie;
use App\Form\EtiologieType;
use App\Repository\EtiologieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class EtiologieController extends AbstractController
{
    //READ
    #[Route('/etiologie', name: 'etiologie.index', methods:['GET'])]
    public function index(
        EtiologieRepository $repository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $etiologies = $paginator->paginate(
        $repository->findAll(),
        $request->query->getInt('page', 1), 10
        );        
        return $this->render('pages/etiologie/index.html.twig', [
            'etiologies' => $etiologies
        ]);


        return $this->render('etiologie/index.html.twig', [
            'controller_name' => 'EtiologieController',
        ]);
    }


    // CREATE
    #[Route('/etiologie/nouveau', name: 'etiologie.new', methods:['GET', 'POST'])]
    public function new( 
        Request $request,
        EntityManagerInterface $manager
    ): Response {
        $etiologie = new Etiologie();
        $form = $this->createForm(EtiologieType::class, $etiologie);
 
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $etiologie = $form->getData();
 
            $manager->persist($etiologie);
            $manager->flush();
 
            $this->addFlash(
                'success',
                'Votre agent étiologique a été ajouté avec succès !'
            ); 
            return $this->redirectToRoute('etiologie.index');
        }
 
        return $this->render('pages/etiologie/new.html.twig',[
            'form' => $form->createView()
        ]);
    }
    
    //UPDATE
    #[Route('/etiologie/edition/{id}', name: 'etiologie.edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        Etiologie $etiologie,
        EntityManagerInterface $manager,
    ): Response {
        $form = $this->createform(EtiologieType::class, $etiologie);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $etiologie = $form->getData();

            $manager->persist($etiologie);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre agent étiologique été modifié avec succès !'
            );

            return $this->redirectToRoute('etiologie.index');
        }
        return $this->render('pages/etiologie/edit.html.twig',[
            'form' => $form->createView()
        ]);

    }

    //DELETE
    #[Route('/etiologie/suppression/{id}', name: 'etiologie.delete', methods:['GET'])]
    public function delete(
        EntityManagerInterface $manager,
        Etiologie $etiologie
    ): Response {
        $manager->remove($etiologie);
        $manager->flush();

        $this->addFlash(
            'success',
            'Votre agent étiologique a été supprimé avec succès !'
        );

        return $this->redirectToRoute('etiologie.index');
    }
}
