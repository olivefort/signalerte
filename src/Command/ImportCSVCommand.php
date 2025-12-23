<?php

namespace App\Command;


use App\Entity\User;
use DateTimeImmutable;
// use DateTime;

// use Symfony\Component\Console\Input\InputOption;
use League\Csv\Reader;
use App\Entity\Etiologie;
use App\Entity\Infection;
use App\Entity\Structure;
// use Monolog\DateTimeImmutable;
use League\Csv\Statement;
use App\Entity\Signalement;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
// use Symfony\Component\Validator\Constraints\DateTime;

// #[AsCommand(
//     name: 'csv:import',
//     description: 'Importer un CSV',
// )]
class ImportCSVCommand extends Command
{
    private $em;
    
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();
        $this->em = $em;
    }

    protected function configure(): void
    {
        $this
            ->setName('csv:import')
            ->setDescription("Import CSV in DB")
        ;
    }


    protected function execute(InputInterface $input,OutputInterface $output): int 
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Import CSV ...');
        $csv = Reader::from('src/Data/FaKESiN.csv', 'r');
        $csv->setHeaderOffset(0);
        $csv->setDelimiter(';');
        $csv->setEscape('');
        $records = $csv->getRecords();      

        // $i = 0;
        foreach ($records as $record){
            $structure = $this->em->getRepository(Structure::class)->findOneBy(['nom' => $record['Nom de la structure']]);
            $infection = $this->em->getRepository(Infection::class)->findOneBy(['infection' => $record['Type infection']]);
            $etiologie = $this->em->getRepository(Etiologie::class)->findOneBy(['agent' => $record['Agent etiologique']]);
            // $infection = (new Infection())
            //     ->setInfection($record['Type infection']);
            // $etiologie = (new Etiologie())
            //     ->setAgent($record['Agent etiologique']);
            
             
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

           
 
 
 
            // $user = (new User())
                // ->setNom($record['nom'])
                // ->setPrenom($record['prenom'])
                // ->setEmail($record['email'])              
                // ->setPlainPassword($record['mdp'])
            // ;
            $this->em->persist($signalement);
            $this->em->persist($infection);
            $this->em->persist($structure);
            $this->em->persist($etiologie);

            // if (++$i % 50 === 0) {
            //     $this->em->flush();
            //     $this->em->clear();
            // }
        }
        $this->em->flush();                
        $io->success('Great CSV in DB !');
        return Command::SUCCESS;
    }

    
}