<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ChefcustoController extends AbstractController
{
    #[Route('/Cuisto', name: 'Mon_chefcusto')]
    public function index(): Response
    {
        return $this->render('chefcusto/index.html.twig', [
            'controller_name' => 'Chef Cuisto',
        ]);
    }
}
