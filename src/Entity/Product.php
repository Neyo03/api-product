<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

use App\Controller\EditApiProductController;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ApiResource(
    collectionOperations:[
        "post"=>[
            "denormalization_context"=>[
                "groups"=>["product:item:post"]
            ],
        ],
        "get"=>[
            "denormalization_context"=>[
                "groups"=>["product:item:get"]
            ],
        ],
        "edit"=>[
            "denormalization_context"=>[
                "groups"=>["product:item:post"]
            ],
            "method" => "PATCH",
            "deserialize" => true,
            "path" => "/products/{id}",
            "controller" => EditApiProductController::class
        ],
        
    ]
)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["product:item:get"])]
    private $id;

    #[ORM\Column(type: 'decimal', precision: 10, scale: '0')]
    #[Groups(["product:item:post", "product:item:get"])]
    #[Assert\NotNull()]
    #[Assert\NotBlank()]
    private $kcal;

    #[ORM\Column(type: 'decimal', precision: 10, scale: '0')]
    #[Groups(["product:item:post", "product:item:get"])]
    #[Assert\NotNull()]
    #[Assert\NotBlank()]
    private $kj;

    #[ORM\Column(type: 'decimal', precision: 10, scale: '0')]
    #[Groups(["product:item:post", "product:item:get"])]
    #[Assert\NotNull()]
    #[Assert\NotBlank()]
    private $fat;

    #[ORM\Column(type: 'decimal', precision: 10, scale: '0')]
    #[Groups(["product:item:post", "product:item:get"])]
    #[Assert\NotNull()]
    #[Assert\NotBlank()]
    private $saturedFat;

    #[ORM\Column(type: 'decimal', precision: 10, scale: '0')]
    #[Groups(["product:item:post", "product:item:get"])]
    #[Assert\NotNull()]
    #[Assert\NotBlank()]
    private $carbohydrate;

    #[ORM\Column(type: 'decimal', precision: 10, scale: '0')]
    #[Groups(["product:item:post", "product:item:get"])]
    #[Assert\NotNull()]
    #[Assert\NotBlank()]
    private $sugar;

    #[ORM\Column(type: 'decimal', precision: 10, scale: '0')]
    #[Groups(["product:item:post", "product:item:get"])]
    #[Assert\NotNull()]
    #[Assert\NotBlank()]
    private $fiber;

    #[ORM\Column(type: 'decimal', precision: 10, scale: '0')]
    #[Groups(["product:item:post", "product:item:get"])]
    #[Assert\NotNull()]
    #[Assert\NotBlank()]
    private $protein;

    #[ORM\Column(type: 'decimal', precision: 10, scale: '0')]
    #[Groups(["product:item:post", "product:item:get"])]
    #[Assert\NotNull()]
    #[Assert\NotBlank()]
    private $salt;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["product:item:post", "product:item:get"])]
    #[Assert\NotNull()]
    #[Assert\NotBlank()]
    private $ean;

    
    #[ORM\OneToMany(targetEntity:Ingredient::class, mappedBy:"product",cascade:["persist"],orphanRemoval:true)]
    #[Groups(["product:item:post", "product:item:get"])]
    private $ingredients;

    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKcal(): ?string
    {
        return $this->kcal;
    }

    public function setKcal(string $kcal): self
    {
        $this->kcal = $kcal;

        return $this;
    }

    public function getKj(): ?string
    {
        return $this->kj;
    }

    public function setKj(string $kj): self
    {
        $this->kj = $kj;

        return $this;
    }

    public function getFat(): ?string
    {
        return $this->fat;
    }

    public function setFat(string $fat): self
    {
        $this->fat = $fat;

        return $this;
    }

    public function getSaturedFat(): ?string
    {
        return $this->saturedFat;
    }

    public function setSaturedFat(string $saturedFat): self
    {
        $this->saturedFat = $saturedFat;

        return $this;
    }

    public function getCarbohydrate(): ?string
    {
        return $this->carbohydrate;
    }

    public function setCarbohydrate(string $carbohydrate): self
    {
        $this->carbohydrate = $carbohydrate;

        return $this;
    }

    public function getSugar(): ?string
    {
        return $this->sugar;
    }

    public function setSugar(string $sugar): self
    {
        $this->sugar = $sugar;

        return $this;
    }

    public function getFiber(): ?string
    {
        return $this->fiber;
    }

    public function setFiber(string $fiber): self
    {
        $this->fiber = $fiber;

        return $this;
    }

    public function getProtein(): ?string
    {
        return $this->protein;
    }

    public function setProtein(string $protein): self
    {
        $this->protein = $protein;

        return $this;
    }

    public function getSalt(): ?string
    {
        return $this->salt;
    }

    public function setSalt(string $salt): self
    {
        $this->salt = $salt;

        return $this;
    }

    public function getEan(): ?string
    {
        return $this->ean;
    }

    public function setEan(string $ean): self
    {
        $this->ean = $ean;

        return $this;
    }

    /**
     * @return Collection<int,Ingredient>
     */
    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function addIngredient(Ingredient $ingredients): self
    {
        if (!$this->ingredients->contains($ingredients)) {
            $this->ingredients[] = $ingredients;
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredients): self
    {
        $this->ingredients->removeElement($ingredients);

        return $this;
    }
}
