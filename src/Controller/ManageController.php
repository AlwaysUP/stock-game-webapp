<?php

namespace App\Controller;
use App\Form\UserType;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class ManageController extends Controller
{
    /**
     * @Route("/manage", name="manage")
     */
    public function index(Request $request, AuthorizationCheckerInterface $authChecker, UserPasswordEncoderInterface $passwordEncoder, ObjectManager $objectManager)
    {
        if (false === $authChecker->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('login');
        }

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

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('login');
        }

        return $this->render(
            'manage/index.html.twig',
            array('form' => $form->createView())
        );
    }
}
