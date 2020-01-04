<?php


namespace App\Common;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class ObjectManager
{
    private $em;

    /**
     * ObjectManager constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function saveObject($_object)
    {
        $object = $_object;
        try{
            $this->em->persist($object);
            $this->em->flush();
            return [
                'code' => 200,
                'message' => 'Ajouter est Avec Succèss'
            ];
        } catch (\Exception $ex) {
            return [
                'code' => 500,
                'message' => 'Enregistrement n\'est pas effectué correctement'
            ];
        }
    }

    public function getEntityManager()
    {
        return $this->em;
    }

}
