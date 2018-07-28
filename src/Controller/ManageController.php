<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ManageController extends Controller
{
    /**
     * @Route("/manage", name="manage")
     */
    public function index()
    {
        return $this->render('manage/index.html.twig', [
            'controller_name' => 'ManageController',
        ]);
    }
}
