<?php


namespace App\Factory;


use App\Entity\Commande;
use App\Entity\CommandProduit;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class CommandFactory
{
    public function commandFactory(Commande $command)
    {
        foreach ($command->getCommandProduits() as $commandProduit) {
            $commandProduit->setCommand($command);
        }
        return $command;
    }

}
