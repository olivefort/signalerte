<?php

namespace App\Controller;

use App\Entity\Souche;
use App\Form\SoucheType;
use App\Repository\SoucheRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class SoucheController extends AbstractController
{
    //READ
    // #[Route('/souche', name: 'souche.index', methods:['GET'])]
    // public function index(
    //     SoucheRepository $repository,
    //     PaginatorInterface $paginator,
    //     Request $request
    // ): Response {
    //     $souches = $paginator->paginate(
    //         $repository->findAll(),
    //         $request->query->getInt('page',1), 20
    //     );
    //     return $this->render('pages/souche/index.html.twig', [
    //         'souches' => $souches
    //     ]);
    // }

    //CREATE
    // #[Route('/souche/nouveau', name:'souche.new', methods:['GET','POST'])]
    // public function new(
    //     Request $request,
    //     EntityManagerInterface $manager
    // ): Response {
    //     $souche = new Souche();
    //     $form = $this->createForm(SoucheType::class, $souche);

    //     $form->HandleRequest($request);
    //     if($form->isSubmitted() && $form->isValid()){
    //         $souche = $form->getData();
    //         $manager->persist($souche);
    //         $manager->flush();
    //         $this->addFlash(
    //             'success',
    //             'Votre souche a été ajouté avec succès !'
    //         );
    //         return $this->redirectToRoute('souche.index');
    //     }
    //     return $this->render('pages/souche/new.html.twig',[
    //         'form'=> $form->createView()
    //     ]);
    // }

    //UPDATE
    // #[Route('/souche/edition/{id}', name:'souche.edit', methods: ['GET','POST'])]
    // public function edit(
    //     Request $request,
    //     EntityManagerInterface $manager,
    //     Souche $souche
    // ): Response {
    //     $form = $this->createForm(SoucheType::class, $souche);
    //     $form->handleRequest($request);

    //     if($form->isSubmitted() && $form->isValid()){
    //         $souche = $form->getData();

    //         $manager->persist($souche);
    //         $manager->flush();

    //         $this->addFlash(
    //             'success',
    //             'Votre souche a été modifié avec succès!'
    //         );
    //         return $this->redirectToRoute('souche.index');
    //     }
    //     return $this->render('pages/souche/edit.html.twig',[
    //         'form' => $form->createView()
    //     ]);
    // }

    //DELETE
//     #[Route('/souche/suppresion/{id}', name: 'souche.delete', methods: ['GET'])]
//     public function delete(
//         EntityManagerInterface $manager,
//         Souche $souche
//     ): Response {
//         $manager->remove($souche);
//         $manager->flush();
    
//         $this->addFlash(
//             'success',
//             'Votre souche a été supprimé avec succès !'
//         );
//         return $this->redirectToRoute('souche.index');
//     }
}
