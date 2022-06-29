<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\LigneCommandeRepository;
use ApiPlatform\Core\Annotation\ApiResource;

#[ORM\Entity(repositoryClass: LigneCommandeRepository::class)]
#[ApiResource]

class LigneCommande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $quantite;

    #[ORM\ManyToOne(targetEntity: Produit::class, inversedBy: 'ligneDeCmd')]
    private $produit;

    #[ORM\ManyToOne(targetEntity: Commande::class, inversedBy: 'ligneDeCmd')]
    private $commande;

    #[ORM\ManyToOne(targetEntity: Ticket::class, inversedBy: 'ligneDeCmds')]
    private $ticket;
 

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): self
    {
        $this->produit = $produit;

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): self
    {
        $this->commande = $commande;

        return $this;
    }

    public function getTicket(): ?Ticket
    {
        return $this->ticket;
    }

    public function setTicket(?Ticket $ticket): self
    {
        $this->ticket = $ticket;

        return $this;
    }

    

    

   
}
