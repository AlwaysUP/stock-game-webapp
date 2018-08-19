<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GambleController extends Controller
{
    /**
     * @Route("/gamble", name="gamble")
     */
    public function index()
    {
        return $this->render('gamble/index.html.twig', [
            'controller_name' => 'GambleController',
        ]);
    }
}
