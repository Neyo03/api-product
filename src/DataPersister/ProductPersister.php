<?php
namespace App\DataPersister;


use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ProductPersister implements DataPersisterInterface{

    private $entityManager; 
   

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    public function supports($data): bool{
        return $data instanceof Product;
    }

    /**
     * persit data
     *
     * @param Product $data
     * @return void
     */
    public function persist($data){
        
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
        foreach($data->getIngredients() as $ingredient ) {
            $ingredient->setProduct($data);
        }
        
        $this->entityManager->persist($data);
        $this->entityManager->flush();

        return new JsonResponse(['success' => 'Produit has been successfully created'], Response::HTTP_OK);
         
    }
        

        

    public function remove($data){
        $this->entityManager->remove($data);
        $this->entityManager->flush();
    }


    
}