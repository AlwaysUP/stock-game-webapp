<?php

namespace App\Controller;

use App\Form\StockType;
use App\Form\BetType;
use App\Entity\User;
use App\Entity\Balance;
use App\Entity\Stock;
use App\Entity\Transaction;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use App\Entity\Bets;


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
    public function pick(Request $request,  AuthorizationCheckerInterface $authChecker)
    {
        if ((false === $authChecker->isGranted('ROLE_USER')) && (false === $authChecker->isGranted('ROLE_ADMIN')) ) {
            return $this->redirectToRoute('login');
        }
        $user = $this->getUser();
        $balance = $this->getDoctrine()
                        ->getRepository(Balance::class)
                        ->findByUserId($user->getId());
        $stocks =  $this->getDoctrine()
                        ->getRepository(Stock::class)
                        ->findAllStocks();
        return $this->render('gamble/index.html.twig', [
            'bet' => false,
            'stocks' => $stocks,
            'user' => $user,
            'balance' => $balance->getAmount(),
        ]);
    }

    /**
     * @Route("/gamble/bet", name="gamble-bet")
     */
    public function bet(Request $request, ObjectManager $objectManager,  AuthorizationCheckerInterface $authChecker)
    {
        if ((false === $authChecker->isGranted('ROLE_USER')) && (false === $authChecker->isGranted('ROLE_ADMIN')) ) {
            return $this->redirectToRoute('login');
        }
        $stockId = $request->query->get('id');
        $stock =   $this->getDoctrine()
                        ->getRepository(Stock::class)
                        ->findById($stockId);
        $user = $this->getUser();

        $balance = $this->getDoctrine()
                        ->getRepository(Balance::class)
                        ->findByUserId($user->getId());

        $bet = new Bets();
        $bet->setUserId($user->getId());
        $bet->setStockId($stock->getId());

        $form = $this->createForm(BetType::class, $bet);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($bet);
            $objectManager->flush();

            if ($balance->getAmount() > $bet->getStakes()){
                $transaction = new Transaction();
                $transaction->setTimestamp($bet->getTimestamp());
                $transaction->setUserId($user->getId());
                $transaction->setCurr('USD');
                $transaction->setAmount($bet->getStakes());
                $transaction->setBetId($bet->getId());

                $objectManager->persist($transaction);
                $objectManager->flush();

                $balance->setAmount($balance->getAmount() - $bet->getStakes());
                $objectManager->persist($balance);
                $objectManager->flush();

            }
            else{
                return "IS NOT GOOD!";
            }
        }



        return $this->render('gamble/index.html.twig', [
            'bet' => true,
            'user' => $user,
            'stock' => $stock,
            'form' => $form->createView(), 
            'balance' => $balance->getAmount(),
        ]);
    }
}
