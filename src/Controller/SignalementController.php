<?php

namespace App\Controller;

use Symfony\UX\Map\Map;
// use App\Form\SearchType;
// use App\Model\SearchData;
use App\Data\FilterData;
use App\Form\FilterType;
use Symfony\UX\Map\Point;
use Symfony\UX\Map\Marker;
use App\Entity\Signalement;
use App\Form\SignalementType;
use Symfony\UX\Map\InfoWindow;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\SignalementRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\UX\Map\Bridge\Leaflet\LeafletOptions;
use Symfony\UX\Map\Bridge\Leaflet\Option\TileLayer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class SignalementController extends AbstractController
{
    //READ
    #[Route('/signalement', name: 'signalement.index', methods:['GET'])]
    public function index(
        SignalementRepository $repository,
        // PaginatorInterface $paginator,
        Request $request
    ): Response {
        $data = new FilterData();
        $form = $this-> createForm(FilterType::class, $data);
        $form->handleRequest($request);
        $signalements = $repository->findSearch($data);
        $monService->importFichier($pathduFichier);
        // dd($signalements[1]);
        // $map = (new Map('default'))
        //     ->center(new Point(47.65, 1.50))
        //     ->zoom(7)
        //     ->addMarker(new Marker(
        //         position: new Point(47.65, 1.50),
        //         title: 'Tours',
        //         infoWindow: new InfoWindow(
        //             content: '<p>CHRU Bretonneau</p>',
        //         )
        //     ));
            // ->options((new LeafletOptions())
            //     ->tileLayer(new TileLayer(
            //         url: 'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
            //         attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            //         options: ['maxZoom' => 25]
            //     ))
            // );

            // $markers = [];
            // foreach ($signalements as $signalement) {
            //     $markers[] = [
            //         'position' => [$signalement->structure->latitude, $signalement->structure->longitude],
            //         'title' => $signalement->structure->nom,
            //     ];
            // }

            // $markers = array_map(function($value) {
            //     return [
            //         'position' => [$value->structure->latitude, $value->structure->longitude],
            //         'title' => $value->structure->nom,
            //     ];
            // }, $signalements);
        return $this->render('pages/signalement/index.html.twig', [
            'signalements'=> $signalements,
            'form' => $form,
            // 'map' => $map,
            // dd($map)
        ]);
    // }

        // $signalements = $paginator->paginate(
        //     $repository->findAll(),
        //     $request->query->getInt('page',1), 20
        // );
        // return $this->render('pages/signalement/index.html.twig', [
        //     'form' => $form->createView(),
        //     'signalements' => $signalements,
        //     'filter' > $filter
        // ]);
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
        return $this->render('pages/signalement/new.html.twig'
            ,['form'=> $form
            // /!\ NE PLUS METTRE : ->createView() /!\
            // ->createView()
            ]
        );
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
            'form' => $form
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
        // PaginatorInterface $paginator,        
        EntityManagerInterface $manager
    ) :Response {
        return $this->render('pages/signalement/show.html.twig', [
            'signalement' => $signalement
        ]);
    }
}
