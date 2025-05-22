<?php

namespace App\Controller;

use App\Entity\Agent;
use App\Form\AgentType;
use App\Repository\AgentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class AgentController extends AbstractController
{
    //READ
    #[Route('/agent', name: 'agent.index', methods:['GET'])]
    public function index(
        AgentRepository $repository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $agents = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1), 10
        );
        return $this->render('pages/agent/index.html.twig', [
            'agents' => $agents
        ]);
    }

    // CREATE
    #[Route('/agent/nouveau', name: 'agent.new', methods:['GET', 'POST'])]
    public function new( 
        Request $request,
        EntityManagerInterface $manager
    ): Response {
        $agent = new Agent();
        $form = $this->createForm(AgentType::class, $agent);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $agent = $form->getData();

            $manager->persist($agent);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre agent a été ajouté avec succès !'
            );

            return $this->redirectToRoute('agent.index');
        }

        return $this->render('pages/agent/new.html.twig',[
            'form' => $form->createView()
        ]);        
    }

    //UPDATE
    #[Route('/agent/edition/{id}', name: 'agent.edit', methods:['GET', 'POST'])]
    public function edit(
        Request $request,
        Agent $agent,
        EntityManagerInterface $manager,
    ): Response {
        $form = $this->createForm(AgentType::class, $agent);
 
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $agent = $form->getData();

            $manager->persist($agent);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre agent a été modifié avec succès !'
            );

            return $this->redirectToRoute('agent.index');
        }
        return $this->render('pages/agent/edit.html.twig',[
            'form' => $form->createView()
        ]);        
    }

    //DELETE
    #[Route('/agent/suppression/{id}', name: 'agent.delete', methods:['GET'])]
    public function delete(
        EntityManagerInterface $manager,
        Agent $agent
    ): Response {
        $manager->remove($agent);
        $manager->flush();

        $this->addFlash(
            'success',
            'Votre agent a été supprimé avec succès !'
        );

        return $this->redirectToRoute('agent.index');        
    }
}


