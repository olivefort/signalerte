<?php

namespace App\Controller;

use Symfony\UX\Map\Map;
use Symfony\UX\Map\Point;
use Symfony\UX\Map\Marker;
use Symfony\UX\Map\InfoWindow;
use App\Repository\SignalementRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\UX\Map\Bridge\Leaflet\LeafletOptions;
use Symfony\UX\Map\Bridge\Leaflet\Option\TileLayer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class MapController extends AbstractController
{
    #[Route('/map', name: 'map.index')]
    public function __invoke(
        SignalementRepository $repository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        // $form->handleRequest($request);
        $test = $paginator->paginate( 
        $repository->findAll(),
        $request->query->getInt('page', 1),10);
        // dd($test);
        $map = (new Map('default'))
            ->center(new Point(47.65, 1.50))
            ->zoom(8)
            ->addMarker(new Marker(
                position: new Point(47.65, 1.50),
                title: 'Tours',
                infoWindow: new InfoWindow(
                    content: '<p>CHRU Bretonneau</p>',
                )
            ))
            ->options((new LeafletOptions())
                ->tileLayer(new TileLayer(
                    url: 'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
                    attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                    options: ['maxZoom' => 25]
                ))
            );
        return $this->render('pages/signalement/index.html.twig', [
            'map' => $map,
        ]);
    }
}
