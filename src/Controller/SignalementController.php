<?php

namespace App\Controller;

use App\Entity\Upload;
// use App\Form\SearchType;
// use App\Model\SearchData;
use League\Csv\Reader;
use Symfony\UX\Map\Map;
use App\Data\FilterData;
use App\Form\FilterType;
use App\Form\ImportType;
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
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class SignalementController extends AbstractController
{
    //READ
    #[Route('/signalement', name: 'signalement.index', methods:['GET', 'POST'])]
    public function index(
        SignalementRepository $repository,
        Request $request
        // PaginatorInterface $paginator,
    ): Response {
        $data = new FilterData();
        $form = $this-> createForm(FilterType::class, $data);
        $form->handleRequest($request);
        $signalements = $repository->findSearch($data);
        // $upload = new Signalement();
        // $formUpload = $this-> createForm(ImportType::class, $upload)
        // $formUpload->handleRequest($request);
        // $monService->importFichier($pathduFichier);
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
            'form' => $form,
            'signalements'=> $signalements,
           
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

    // #[Route('/signalement/upload', name: 'signalement.upload', methods:['GET', 'POST'])]
    // public function upload(

    // ): Response { 
    //     return $this->render('pages/signalement/upload.html.twig');
    // }

     #[Route('/signalement/upload', name: 'signalement.upload', methods:['GET', 'POST'])]
    public function upload(
        Request $request,
        SluggerInterface $slugger,
        // EntityManagerInterface $manager,
        // Signalement $signalement,
        //  #[Autowire('%kernel.project_dir%/public/uploads/users')] string $fileDirectory
    )  : Response {
            $upload = new Upload();
            $form = $this->createForm(ImportType::class, $upload);
            $form->handleRequest($request);
           
            if ($form->isSubmitted() && $form->isValid()) {
                $file = $form -> get('csvFile')->getData();
                dd($file);
                if($file){
                    $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $safeFileName = $slugger->slug($fileName);
                    // $fileName = md5(uniqid()).'.'.$file->guessExtension(); 
                    // dd($safeFileName);
                    $newFileName = $safeFileName.'-'.uniqid().'.'.$file->guessExtension();
                    // dd($newFileName);
                    // $file->move($this->getParameter('csvFile', $fileName));
                    $upload->setCsvFile($newFileName);
                    // dd($upload);
                    $csv = Reader::createFromPath('%kernel.root.dir%/../public/uploads/'.$fileName);
                    dd($csv);
                    $csv->setHeaderOffset(0);
                    $csv->setDelimiter(';');
                    $csv->setEscape('');
                    $records = $csv->getRecords();
                    foreach ($records as $record){ 
                        $structure = $this->em->getRepository(Structure::class)->findOneBy(['nom' => $record['Nom de la structure']]);
                        $infection = $this->em->getRepository(Infection::class)->findOneBy(['infection' => $record['Type infection']]);
                        $etiologie = $this->em->getRepository(Etiologie::class)->findOneBy(['agent' => $record['Agent etiologique']]);          
                
                        $date = $record['Date du signalement'];
                        $dbdate = \DateTimeImmutable::createFromFormat('d/m/Y', $date);
                        $signalement = (new Signalement())
                            ->setNumero($record['Identifiant de la fiche'])
                            ->setType($record['ESiN ou Portail'])
                            ->setDate($dbdate)
                            ->setCasO($record['Cas origine'])
                            ->setCasC($record['Cas cloture'])
                            ->setCommentaire($record['Commentaire'])
                            ->setEpidemie($record['Type de cas'])
                            ->setCapacite($record['Capacite de gestion locale'])
                            ->setGravite($record['Gravite'])
                            ->setImpact($record['Impact echelle'])
                            ->setMesure($record['Mesures efficaces'])
                            ->setReco($record['Mesure conforme aux reco'])
                            ->setPopulation($record['Population a risque'])
                            ->setScore($record['Score'])
                            ->setARS($record['Score ARS'])
                            ->setES($record['Score ES'])
                            ->setCPIAS($record['Score CPIAS'])
                            ->setSPF($record['Score SPF'])
                            ->setInfection($infection)               
                            ->setEtiologie($etiologie)
                            ->setStructure($structure)
                            ;
                            $this->em->persist($signalement);
                            $this->em->persist($infection);
                            $this->em->persist($structure);
                            $this->em->persist($etiologie);
                    }
                    
                }
                $this->em->flush();
                    $this->addFlash('success','Bien ajouté avec succès');
                    return $this->redirectToRoute('signalement.index');
            }
        return $this->render('pages/signalement/upload.html.twig',
            ['form' => $form,]);
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
    #[Route('/signalement/suppression/{id}', name: 'signalement.delete', methods: ['GET'])]
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
