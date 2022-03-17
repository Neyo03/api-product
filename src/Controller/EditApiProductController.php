<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EditApiProductController extends AbstractController
{
    private $entityManager; 
   

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    public function __invoke(Request $request, ProductRepository $productRepository, Product $data)
    {   
        $id = $request->get('id');
        $product = $productRepository->findOneBy(['id' =>$id ]);

        if($data->getKj() <= $data->getKcal()*4.18) {
            return new JsonResponse(['error' => 'Kj must be greater than Kcal'], Response::HTTP_BAD_REQUEST);
        }
        if($data->getSaturedFat() > $data->getFat()) {
            return new JsonResponse(['error' => 'Satured fat must be less or egal than Fat'], Response::HTTP_BAD_REQUEST);
        }
        if($data->getSugar() > $data->getCarbohydrate()) {
            return new JsonResponse(['error' => 'Sugar fat must be less or egal than Carbohydrate'], Response::HTTP_BAD_REQUEST);
        }
        if(count($data->getIngredients())<=0) {
            return new JsonResponse(['error' => 'Ingredients cannot be empty'], Response::HTTP_BAD_REQUEST);
        }
        
    
        $product->setCarbohydrate($data->getCarbohydrate());
        $product->setSugar($data->getSugar());
        $product->setKcal($data->getKcal());
        $product->setKj($data->getKj());
        $product->setSalt($data->getSalt());
        $product->setFat($data->getFat());
        $product->setSaturedFat($data->getSaturedFat());
        $product->setProtein($data->getProtein());
        $product->setEan($data->getEan());
        $product->setFiber($data->getFiber());

        foreach($product->getIngredients() as $ingredient ) {
            $this->entityManager->remove($ingredient);
        }
        foreach($data->getIngredients() as $ingredient ) {
            $ingredient->setProduct($product);
            $product->addIngredient($ingredient);
        }
        
        
        $this->entityManager->persist($product);
        $this->entityManager->flush();

        return new JsonResponse(['success' => 'Produit '. $id .' has been successfully edited'], Response::HTTP_OK);

        
    }
}