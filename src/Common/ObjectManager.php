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
            return true;
        } catch (\Exception $ex) {
            return false;
        }


    }

}
