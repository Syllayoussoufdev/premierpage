<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RappeleController extends AbstractController
{
    #[Route('/rappele', name: 'rappelle')]
    public function index(): Response
    {
        return $this->render('rappele/index.html.twig', [
            'controller_name' => 'RappeleController',
        ]);
    }
}
