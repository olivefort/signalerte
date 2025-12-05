<?php

namespace App\Command;

use App\Entity\User;

use League\Csv\Reader;
use League\Csv\Statement;

// use Symfony\Component\Console\Input\InputOption;
use Doctrine\ORM\EntityManagerInterface;
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

        $csv = Reader::from('src/Data/testuser.csv', 'r');
        $csv->setHeaderOffset(0);
        $csv->setDelimiter(';');
        $csv->setEscape('');
        $records = $csv->getRecords();
      

        $i = 0;
        foreach ($records as $record){
 
            $user = (new User())
                ->setNom($record['nom'])
                ->setPrenom($record['prenom'])
                ->setEmail($record['email'])              
                ->setPlainPassword($record['password'])
            ;
            $this->em->persist($user);

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