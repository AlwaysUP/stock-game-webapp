<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ErrorController extends Controller
{
    /**
     * @Route("/error", name="error")
     */
    public function index()
    {
        throw $this->createNotFoundException('Support Group does not exist');
    }
}
