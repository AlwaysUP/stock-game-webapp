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


class GambleController extends Controller
{
    /**
     * @Route("/gamble", name="gamble")
     */
    public function index()
    {        
        return $this->redirectToRoute('gamble-pick');
    }

    /**
     * @Route("/gamble/pick", name="gamble-pick")
     */
    public function pick()
    {
        $user = $this->getUser();
        $stocks =  $this->getDoctrine()
                        ->getRepository(Stock::class)
                        ->findAllStocks();
        return $this->render('gamble/index.html.twig', [
            'bet' => false,
            'stocks' => $stocks,
            'user' => $user,
        ]);
    }

    /**
     * @Route("/gamble/bet", name="gamble-bet")
     */
    public function bet(Request $request)
    {
        $stockId = $request->attributes->get('id');
        $stock =   $this->getDoctrine()
                        ->getRepository(Stock::class)
                        ->findById($stockId);
        $user = $this->getUser();
        return $this->render('gamble/index.html.twig', [
            'bet' => true,
            'user' => $user,
            'stock' => $stock,
        ]);
    }
}
