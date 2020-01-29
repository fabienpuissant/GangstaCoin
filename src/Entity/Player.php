<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlayerRepository")
 */
class Player
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Username;

    /**
     * @ORM\Column(type="float")
     */
    private $Coins;

    /**
     * @ORM\Column(type="integer")
     */
    private $Miners;

    /**
     * @ORM\Column(type="float")
     */
    private $Bank;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->Username;
    }

    public function setUsername(string $Username): self
    {
        $this->Username = $Username;

        return $this;
    }

    public function getCoins(): ?float
    {
        return $this->Coins;
    }

    public function setCoins(float $Coins): self
    {
        $this->Coins = $Coins;

        return $this;
    }

    public function getMiners(): ?int
    {
        return $this->Miners;
    }

    public function setMiners(int $Miners): self
    {
        $this->Miners = $Miners;

        return $this;
    }

    public function getBank(): ?float
    {
        return $this->Bank;
    }

    public function setBank(float $Bank): self
    {
        $this->Bank = $Bank;

        return $this;
    }
}
