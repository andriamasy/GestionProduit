<?php


namespace App\Managers;


use App\Common\ObjectManager;
use App\Entity\User;
use Doctrine\ORM\Query;

class UserManager
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * UserManager constructor.
     * @param ObjectManager $objectManager
     */
    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * @param $_role
     * @return Query
     */
    public function getUserByRole($_role)
    {
        $role = $_role;
        $em = $this->objectManager->getEntityManager();
        $aoUser = $em->getRepository(User::class)->getUserByRole($role);
        return $aoUser;
    }

    public function saveUser(User $user)
    {
        $bReturn = $this->objectManager->saveObject($user);
        return $bReturn;
    }

}
