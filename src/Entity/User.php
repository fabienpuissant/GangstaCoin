<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Serializable;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface, Serializable
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
     * @ORM\Column(type="string", length=255)
     */
    private $Email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Mdp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Confirmation_token;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isConfirmed = false;


    public function __construct()
    {
        $this->Confirmation_token = $this->initConfirmationToken();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return htmlentities($this->Username);
    }

    public function setUsername(string $Username): self
    {
        $this->Username = htmlentities($Username);

        return $this;
    }

    public function getEmail(): ?string
    {
        return htmlentities($this->Email);
    }

    public function setEmail(string $Email): self
    {
        $this->Email = htmlentities($Email);

        return $this;
    }

    public function getMdp(): ?string
    {
        return htmlentities($this->Mdp);
    }

    public function setMdp(string $Mdp): self
    {
        $this->Mdp = htmlentities($Mdp);

        return $this;
    }

    public function getConfirmationToken(): ?string
    {
        return $this->Confirmation_token;
    }

    public function setConfirmationToken(string $Confirmation_token): self
    {
        $this->Confirmation_token = $Confirmation_token;

        return $this;
    }

    public function getIsConfirmed(): ?bool
    {
        return $this->isConfirmed;
    }

    public function setIsConfirmed(bool $isConfirmed): self
    {
        $this->isConfirmed = $isConfirmed;

        return $this;
    }

    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {
        
    }

    public function serialize()
    {
        return serialize([
            $this->id,
            $this->Email,
            $this->Username,
            $this->Mdp
        ]);
    }

    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->Email,
            $this->Username,
            $this->Mdp) = unserialize($serialized, ["allowed_classes" => false]);
    }

    private function initConfirmationToken() {
            $length = 10;
            $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
            return substr(str_shuffle(str_repeat($alphabet, $length)), 0 , $length);
    }
}
