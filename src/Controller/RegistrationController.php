<?php

namespace App\Controller;

use App\Form\UserType;
use App\Entity\User;
use App\Entity\Stat;
use App\Entity\Balance;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends Controller
{
    /**
     * @Route("/register", name="user_registration")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, ObjectManager $objectManager)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $user->setRoles('ROLE_USER');
            $user->setusername($user->getEmail());
           
            $objectManager->persist($user);
            $objectManager->flush();

            $stat = new Stat();
            $stat->setUserId($user->getId());
            $stat->setProfit(0);
            $stat->setWin(0);
            $stat->setLoss(0);
            $objectManager->persist($stat);
            $objectManager->flush();

            $balance = new Balance();
            $balance->setUserId($user->getId());
            $balance->setCurr('USD');
            $balance->setAmount(50000);

            $objectManager->persist($balance);
            $objectManager->flush();
            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('login');
        }

        return $this->render(
            'registration/register.html.twig',
            array('form' => $form->createView())
        );
    }
}