<?php

namespace App\Entity;

use App\Repository\TransactionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransactionRepository::class)]
class Transaction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $montant = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type:"string",enumType: TransactionType::class)]
    private TransactionType|null $typeTransaction = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $compteRecus = null;

    #[ORM\ManyToOne(inversedBy: 'transactions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Compte $idCompte = null;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): static
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getTypeTransaction(): ?object
    {
        return $this->typeTransaction;
    }

    public function setTypeTransaction(TransactionType $typeTransaction): static
    {
        $this->typeTransaction = $typeTransaction;

        return $this;
    }

    public function getCompteRecus(): ?string
    {
        return $this->compteRecus;
    }

    public function setCompteRecus(?string $compteRecus): static
    {
        $this->compteRecus = $compteRecus;

        return $this;
    }
    public function __toString()
    {
        return $this->typeTransaction->name; // Replace with the property that represents the string representation of the TransactionType
    }

    public function getIdCompte(): ?Compte
    {
        return $this->idCompte;
    }

    public function setIdCompte(?Compte $idCompte): static
    {
        $this->idCompte = $idCompte;

        return $this;
    }


}
