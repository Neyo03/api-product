<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\IngredientRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/create/product', name: 'app_create_product')]
    public function create(Request $request): Response
    {
        $form = $this->createForm(ProductType::class);
        $form->handleRequest($request);

        return $this->render('create_product/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/edit/product/{id}', name: 'app_edit_product')]
    public function edit(Product $product,Request $request ): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
        
       
        return $this->render('edit_product/index.html.twig', [
            'form' => $form->createView(),
         
        ]);
    }


}
