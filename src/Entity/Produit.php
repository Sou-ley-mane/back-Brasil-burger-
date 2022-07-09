<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\Collection;
// use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiResource;
use phpDocumentor\Reflection\Types\Nullable;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
// use Symfony\Component\Validator\Validator\ValidatorInterface;
// use Symfony\Component\Validator\Validator\ValidatorInterface;

#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name:"type",type:"string")]
#[ORM\DiscriminatorMap([
     "burger"=>"Burger",
     "menu"=>"Menu",
     "boisson"=>"Boisson",
     "frite"=>"Frites"
     ])]

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
#[ApiResource(

    collectionOperations:[
        "get"=>[
            'normalization_context' => ['groups' => ["produit:read"]],],
           
            ]
    )]


class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    // #[Groups(["produit:write:burger"])]
    // #[Groups([
    //     // "produit:write:menu"
    //     // 'produit:read:burger',
    
    //     ]
    //     )]
   
    protected $id;

 

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups([
        "produit:write:burger",
        "produit:write:boisson",
        "produit:write:frite"])]
    // #[Assert\NotBlank(message:"Le nom du produit  est Obligatoire")]
    protected $nomProduit;

   
    // #[Groups(['produit:read:burger','produit:menu:read',"produit:write:burger"])]
    #[Groups(["produit:write:burger","produit:write:boisson","produit:write:frite"])]
    // #[Groups([""])]
    #[ORM\Column(type: 'string', length: 255)]
    protected $image;

    // #[Groups(['produit:menu:read'])]
    // #[Groups(['produit:read:burger',
    // 'produit:menu:read',
    // "produit:write:burger"])]
    // #[Groups(["menu:entrer"])]
    // #[Assert\NotBlank(message:"Le prix du produit  est Obligatoire")]
    #[Groups(["produit:write:burger","produit:write:boisson","produit:write:frite"])]
    #[ORM\Column(type: 'integer')]
    protected $prix;

   
    #[ORM\Column(type: 'string', length: 255)]
    protected $etatProduit="true";

    // #[Groups(['produit:read:burger'])]
    #[ORM\ManyToOne(targetEntity: Gestionnaire::class, inversedBy: 'produits')]
    private $gestionnaire;
    // #[ORM\ManyToMany(targetEntity: Commande::class, inversedBy: 'produits')]
    // private $commandes;
    
    // #[Groups(['produit:menu:read'])]
    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: LigneCommande::class)]
    private $ligneCommandes;

    
    public function __construct()
    {
        
        $this->ligneCommandes = new ArrayCollection();
    }

  

  
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomProduit(): ?string
    {
        return $this->nomProduit;
    }

    public function setNomProduit(string $nomProduit): self
    {
        $this->nomProduit = $nomProduit;

        return $this;
    }


    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getEtatProduit(): ?string
    {
        return $this->etatProduit;
    }

    public function setEtatProduit(string $etatProduit): self
    {
        $this->etatProduit = $etatProduit;

        return $this;
    }

    public function getGestionnaire(): ?Gestionnaire
    {
        return $this->gestionnaire;
    }

    public function setGestionnaire(?Gestionnaire $gestionnaire): self
    {
        $this->gestionnaire = $gestionnaire;

        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */
    // public function getCommandes(): Collection
    // {
    //     return $this->commandes;
    // }

    // public function addCommande(Commande $commande): self
    // {
    //     if (!$this->commandes->contains($commande)) {
    //         $this->commandes[] = $commande;
    //     }

    //     return $this;
    // }

    // public function removeCommande(Commande $commande): self
    // {
    //     $this->commandes->removeElement($commande);

    //     return $this;
    // }

    /**
     * @return Collection<int, LigneCommande>
     */
    public function getLigneCommandes(): Collection
    {
        return $this->ligneCommandes;
    }

    public function addLigneCommande(LigneCommande $ligneCommande): self
    {
        if (!$this->ligneCommandes->contains($ligneCommande)) {
            $this->ligneCommandes[] = $ligneCommande;
            $ligneCommande->setProduit($this);
        }

        return $this;
    }

    public function removeLigneCommande(LigneCommande $ligneCommande): self
    {
        if ($this->ligneCommandes->removeElement($ligneCommande)) {
            // set the owning side to null (unless already changed)
            if ($ligneCommande->getProduit() === $this) {
                $ligneCommande->setProduit(null);
            }
        }

        return $this;
    }



    

 
}
