<?php

namespace App\Controller;

use App\Entity\Recette;
use App\Form\RecetteType;
use App\Repository\RecetteRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RecipeController extends AbstractController
{
    #[Route(path:"/recette", name:"recipe.index")]
        public function index(Request $request, RecetteRepository $repository, EntityManagerInterface $em): Response{
            /** creation de nouvelle resccette
             */
            /*$recettes = new Recette();
            $recettes->setTitle("vermisou")
                ->setContenu('Contenu du gboson en fonction de l entré saisie')
                ->setSlug('verminesous')
                ->setDuration(15)
                ->setUpdatedAt(new \DateTimeImmutable())
                ->setCreatedAt(new \DateTimeImmutable());
                
            $em ->persist($recettes);
            $em ->flush();
            $recettes = $repository->findAll();#attribition des entréé 
*/
            /*$recettes = $repository->findAll();
             /* Vérifie si l'index 5 existe avant de modifier
             Modification des donné  à l'idex entr []*
            if (isset($recettes[15])) {
                $recettes[12]->setTitle('mODIFIER ');
                $recettes[10] -> setTitle('Double MoDIFICATION ');
                $em->flush(); // Enregistre les modifications dans la base
                return $this->render('/recipe/index.html.twig',[
                    'controller_name' => 'RecipeController',
                   'recettes'=> $recettes,
                ]);
            }
            return $this->render('/recipe/index.html.twig',[
            'recettes'=> $recettes,
        ]); /*new Response("Page>Recette de cuisine");!*/
        /*$recettes = $repository->findAll();
        if (isset($recettes[10])) {
        $em->remove($recettes[3]);/**Suppression de la ligne de l'index [10] *
        $em->flush();
        $recettes = $repository->findAll();
        return $this->render('/recipe/index.html.twig',[
            'controller_name' => 'RecipeController',
           'recettes'=> $recettes,
        ]);
        }
        return $this->render('/recipe/index.html.twig',[
            'controller_name' => 'RecipeController',
           'recettes'=> $recettes,
        ]);*/
        $recettes = $repository->findAll();
        return $this->render('/recipe/index.html.twig', [
            'controller_name' => 'RecipeController',
           'recettes'=> $recettes,
        ]);
              
        }

    #[Route('/recette/{slug}-{id}', name: 'recipe.show', requirements: ['id'=>'\d+', 'slug'=>'[a-z0-9-]+'])]
    public function show(Request $request, string $slug, int $id, RecetteRepository $repository, EntityManagerInterface $entityManager): Response
    {
        $recette = $repository->find($id);
    
        if ($recette->getSlug() != $slug) {
            return $this->redirectToRoute('recipe.show', [
                'slug' => $recette->getSlug(),
                'id' => $recette->getId()
            ]);
        }
        
        return $this->render('/recipe/show.html.twig', [
            'recette' => $recette
        ]);
    }
    #[Route("/recette/{id}/edit", name : "recipe.edit")]
    public function edit(Request $request, RecetteRepository $repository, EntityManagerInterface $em, Recette $recette) : Response{
        /**
         *création du formulaire
         
        $form = $this->createForm(RecetteType::class, $recette);
        return $this->render('recipe/edit.html.twig', [
            'recette' => $recette,
            'form' => $form
        ]);*/
        $form = $this->createForm(RecetteType::class, $recette);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($recette);
            $em->flush();
    
            return $this->redirectToRoute('recipe.show', [
                'id' => $recette->getId(),
                'slug' => $recette->getSlug()
            ]);
        }
    
        return $this->render('recipe/edit.html.twig', [
            'recette' => $recette,
            'form' => $form->createView()
        ]);
    }
}
