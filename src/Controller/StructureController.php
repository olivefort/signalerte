<?php

namespace App\Controller;

use App\Data\FilterData;
use App\Form\FilterType;
use App\Entity\Structure;
use App\Form\StructureType;
use App\Data\FilterStructure;
use App\Form\FilterStructType;
use App\Repository\StructureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class StructureController extends AbstractController
{
    // READ
    #[Route('/structure', name: 'structure.index', methods:['GET'])]
    public function index( 
        StructureRepository $repository,
        // PaginatorInterface $paginator,
        Request $request
    ): Response {
        $data = new FilterStructure();
        $form = $this-> createForm(FilterStructType::class, $data);
        $form->handleRequest($request);
        $structures = $repository->findSearch($data);
        // $structures = $paginator->paginate(
        //     $repository->findAll(),
        //     $request->query->getInt('page', 1), 20
        // );        
        return $this->render('pages/structure/index.html.twig', [
            'structures' => $structures,
            'form' => $form
        ]);        
    }

        // CREATE
        #[Route('/structure/nouveau', name: 'structure.new', methods:['GET', 'POST'])]
        public function new( 
            Request $request,
            EntityManagerInterface $manager
        ): Response {
            $structure = new Structure();
            $form = $this->createForm(StructureType::class, $structure);
    
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                $structure = $form->getData();
    
                $manager->persist($structure);
                $manager->flush();
    
                $this->addFlash(
                    'success',
                    'Votre structure a été ajouté avec succès !'
                );
                return $this->redirectToRoute('structure.index');        }
    
            return $this->render('pages/structure/new.html.twig',[
                'form' => $form->createView()
            ]);
        }
        
        //UPDATE
        #[Route('/structure/edition/{id}', name: 'structure.edit', methods:['GET', 'POST'])]
        public function edit(
            Request $request,
            Structure $structure,
            EntityManagerInterface $manager,
        ): Response {
            $form = $this->createForm(StructureType::class, $structure);
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                $structure = $form->getData();

                $manager->persist($structure);
                $manager->flush();

                $this->addFlash(
                    'success',
                    'Votre structure a été modifié avec succès !'
                );
                return $this->redirectToRoute('structure.index');
            }
            return $this->render('pages/structure/edit.html.twig',[
                'form' => $form->createView()
            ]);
        }

        // DELETE
        #[Route('/structure/suppression/{id}', name: 'structure.delete', methods:['GET'])]
        public function delete(
            EntityManagerInterface $manager,
            Structure $structure
        ): Response {
            $manager->remove($structure);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre structure a été supprimé avec succès !'
            );
            return $this->redirectToRoute('structure.index');
        }
}
