<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;



#[ORM\Entity(repositoryClass: IngredientRepository::class)]
#[ApiResource(
    collectionOperations:[
        "post"=>[
            "denormalization_context"=>[
                "groups"=>["ingredient:item:post"]
            ],
        ],
        "get"=>[
            "denormalization_context"=>[
                "groups"=>["ingredient:item:get"]
            ],
        ]
    ]
    
)]
class Ingredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["product:item:post","product:item:get", "ingredient:item:post", "ingredient:item:get"])]
    private $name;

    #[ORM\ManyToOne(targetEntity:Product::class, inversedBy:"ingredients", cascade:["persist"])]
    #[Groups(["ingredient:item:post"])]
    private $product;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    
}
