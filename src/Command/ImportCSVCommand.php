<?php

namespace App\Command;

use App\Entity\User;
use League\Csv\Reader;
use Doctrine\ORM\EntityManagerInterface;

// use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

// #[AsCommand(
//     name: 'csv:import',
//     description: 'Importer un CSV',
// )]
class ImportCSVCommand extends Command
{
    private $em;
    
    // protected static $defaultName = 'app:create-users-from-file';

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();
        $this->em = $em;
    }

    protected function configure() 
    // : void
    {
        $this
            ->setName('csv:import')
            ->setDescription("Import de données CSV d'un document en.csv vers la base de donnée")
            // ->addArgument('fichier', InputArgument::REQUIRED, 'Chemin vers le document csv')
        ;
    }


    protected function execute(
        InputInterface $input, 
        OutputInterface $output
        )
        : int 
        {
        
        // $fichier = $input->getArgument('fichier');
        // $fichier = fopen("/src/Data/testuser.csv", "r");
        // dd($fichier);
        // $fichierCsv = fopen($fichier, 'r');
        $io = new SymfonyStyle($input, $output);

        $io->title('Import du CSV ...');

        $reader = Reader::createFromPath('%kernel.root_dir%/../src/Data/testuser.csv', 'w');

        $results = $reader->fetchAssoc();

        foreach ($results as $row) {
            $user = (new User())
                ->setNom($row['nom'])
                ->setPrenom($row['prenom'])
                ->setEmail($row['email'])
                ->setRoles($row['roles'])
                ->setPlainPassword($row['password']);

            $this->em->persist($user);
            
        }

        // $user = (new User())
        //     ->setNom($nom)
        //     ->setPrenom($prenom)
        //     ->setMail($email)
        //     ->setRoles($roles)
        //     ->setPlainPassword($plainPassword)

      
        $this->em->flush();

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }

    // private function createUsers(): void
    // {

    // }
}
