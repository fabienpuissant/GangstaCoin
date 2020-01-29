<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @param string Email to check
     * @return bool 
     */
    public function checkValidEmail($email) 
    {
        $all_users = $this->findAll();
        foreach($all_users as $value)
        {
            if($value->getEmail() == $email)
            {
                return false;
            }
        }
        return true;
    }

    /**
     * @param string Username to check
     * @return bool 
     */
    public function checkValidUsername($username) 
    {
        $all_users = $this->findAll();
        foreach($all_users as $value)
        {
            if($value->getUsername() == $username)
            {
                return false;
            }
        }
        return true;
    }

    
    /**
     * @param string Password to check
     * @return bool 
     */
    public function checkValidMdp($mdp)
    {
        if(strlen($mdp) < 6)
        {
            return false;
        }
        else if(strtolower($mdp) == $mdp){
            return false;
        }
        else {
            return true;
        }
        
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
