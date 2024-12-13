<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
   #[Route('/', name: 'home')]
    public function index(Request $request): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'PAge acceuille',
        ]);/*
        dd($request);
        return new Response('Première page de Symfonyfait par ' .$request->query->get('name','Sylla'));*/
    }
}
