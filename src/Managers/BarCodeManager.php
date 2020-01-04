<?php


namespace App\Managers;


use App\Common\ObjectManager;
use App\Entity\BarCode;

class BarCodeManager
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * BarCodeManager constructor.
     * @param ObjectManager $objectManager
     */
    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function getAll()
    {
        $aoBarCode = $this->objectManager->getEntityManager()->getRepository(BarCode::class)->findAll();
        return $aoBarCode;
    }

    public function saveBarCode($barCode)
    {
        dump($barCode); die;
    }
}
