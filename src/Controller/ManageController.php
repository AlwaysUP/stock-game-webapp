<?php

namespace App\Controller;
use App\Form\UpdateUserType;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class ManageController extends Controller
{
    /**
     * @Route("/manage", name="manage")
     */
    public function index(Request $request, AuthorizationCheckerInterface $authChecker, UserPasswordEncoderInterface $passwordEncoder, ObjectManager $objectManager)
    {
        if ((false === $authChecker->isGranted('ROLE_USER')) && (false === $authChecker->isGranted('ROLE_ADMIN')) ) {
            return $this->redirectToRoute('login');
        }
        $user = $this->getUser();
        $newUser = new User;
        $form = $this->createForm(UpdateUserType::class, $newUser);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //update from new user to user object based on whether it exists or not
            // dump($newUser);
            // die();
            if ($newUser->getPlainPassword()){
                $password = $passwordEncoder->encodePassword($user, $newUser->getPlainPassword());
                $user->setPassword($password);
            }
            
            if($newUser->getEmail()){
                $user->setEmail($newUser->getEmail());
                $user->setUsername($newUser->getEmail());
            }
            
            if($newUser->getFullName()){
                $user->setFullName($newUser->getFullName());
            }

            if($newUser->getZip()){
                $user->setZip($newUser->getZip());
            }

            if($newUser->getCity()){
                $user->setCity($newUser->getCity());
            }

            if($newUser->getStreet()){
                $user->setStreet($newUser->getStreet());
            }

            if($newUser->getPaypal()){
                $user->setPaypal($newUser->getPaypal());
            }

            $objectManager->persist($user);
            $objectManager->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flashbag" success message for the user

            return $this->redirectToRoute('manage');
        }

        return $this->render(
            'manage/index.html.twig',
            array(
                'form' => $form->createView(),
                'username' => $user->getFullName(),
                'email' => $user->getEmail(),
                'zipcode' => $user->getZip(),
                'ipaddr' => $_SERVER['REMOTE_ADDR']
            )
        );
    }
}
