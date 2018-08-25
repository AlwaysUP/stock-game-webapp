<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Stat;

class StatController extends Controller
{
    /**
     * @Route("/top", name="stat")
     */
    public function topStat(ObjectManager $objectManager, AuthorizationCheckerInterface $authChecker)
    {
        $users = array();
        $stats = $this->getDoctrine()
                        ->getRepository(Stat::class)
                        ->getTopStats();
        foreach ($stats as $stat){
            $user = array();
            $user["stat"] = $stat;
            $user["user"] = $this->getDoctrine()
                                    ->getRepository(User::class)
                                    ->findById($stat->getUserId());
            $users[] = $user;
        }
        return $this->render('stat/index.html.twig', [
            'users' => $users,
            'indiv' => false,
        ]);
    }

    /**
     * @Route("/stat", name="my-stat")
     */
    public function userStat(AuthorizationCheckerInterface $authChecker)
    {
        $user = $this->getUser();
        $stat =  $this->getDoctrine()
                        ->getRepository(Stat::class)
                        ->findById($user->getId());
        return $this->render('stat/index.html.twig', [
            'stat' => $stat,
            'indiv' => true,
            'user' => $user,
        ]);
    }
}
