<?php


namespace App\Managers;


use App\Common\ObjectManager;
use App\Entity\Category;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class CategoriesManager
{
    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var ObjectManager
     */
    private $objectManager;

    public function __construct(EntityManagerInterface $em, ObjectManager $objectManager)
    {
        $this->em = $em;
        $this->objectManager = $objectManager;
    }

    public function getAllCategorie()
    {
        $aoCategories = $this->em->getRepository(Category::class)->getAllQuery();
        return $aoCategories;
    }

    public function saveCategorie(Category $category)
    {
        $bReturn = $this->objectManager->saveObject($category);
        return $bReturn;
    }

    public function isActivated( Array $_adata)
    {
        $aReturn = [];
        $oCategory = $this->em->getRepository(Category::class)->findOneBy([
            'id'=> (int)$_adata['id'],
        ]);
        $oCategory->setIsActivated($_adata['isActivated']);
        $bReturn = $this->objectManager->saveObject($oCategory);
        if($bReturn) {
            $aReturn['code'] = 200;
            $aReturn['message'] = $_adata['isActivated'] ?  "Activation est avec Success" : "Désactivation est avec success";
        }

        return $aReturn;
    }

    public function delete(Category $category)
    {
        $aReturn = [];
        $oCategory = $category;
        $oCategory->setIsDeleted(true);
        $bReturn = $this->objectManager->saveObject($category);
        if($bReturn) {
            $aReturn['code'] = 200;
            $aReturn['message'] = "Suppression est avec success";
        } else {
            $aReturn['code'] = 500;
            $aReturn['message'] = "error!! ";
        }
        return $aReturn;
    }
}
