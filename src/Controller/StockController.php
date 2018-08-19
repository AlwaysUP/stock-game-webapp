<?php

namespace App\Controller;

use App\Form\StockType;
use App\Entity\User;
use App\Entity\Stock;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class StockController extends Controller
{
    /**
     * @Route("/stock-add", name="add_stock")
     */
    public function add(Request $request, AuthorizationCheckerInterface $authChecker, ObjectManager $objectManager)
    {
        if (false === $authChecker->isGranted('ROLE_USER')){
            return $this->redirectToRoute('list_stock');
        }
        $stock = new Stock();
        $form = $this->createForm(StockType::class, $stock);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($stock);
            $objectManager->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('list_stock');
        }

        return $this->render(
            'stock/index.html.twig',
            array(
                'csrf_protection' => false,
                'list' => false,
                'form' => $form->createView(),                
            )
        );
    }

    /**
     * @Route("/stock-list", name="list_stock")
     */
    public function list()
    {
        $stocks =  $this->getDoctrine()
                        ->getRepository(Stock::class)
                        ->findAllStocks();
        return $this->render('stock/index.html.twig', [
            'csrf_protection' => false,
            'list' => true,
            'stocks' => $stocks,
        ]);
    }
}
