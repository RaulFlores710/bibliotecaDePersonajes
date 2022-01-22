<?php

namespace App\Entity;

use App\Repository\PersonajeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonajeRepository::class)
 */
class Personaje
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nombre;

    /**
     * @ORM\Column(type="integer")
     */
    private $edad;



    /**
     * @ORM\Column(type="string", length=8000, nullable=true)
     */
    private $historia;

    /**
     * @ORM\ManyToOne(targetEntity=Raza::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $raza;

    /**
     * @ORM\ManyToOne(targetEntity=Clase::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $clase;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $foto;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): self
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    public function getEdad(): ?int
    {
        return $this->edad;
    }

    public function setEdad(int $edad): self
    {
        $this->edad = $edad;

        return $this;
    }


    public function getHistoria(): ?string
    {
        return $this->historia;
    }

    public function setHistoria(?string $historia): self
    {
        $this->historia = $historia;

        return $this;
    }

    public function getRaza(): ?Raza
    {
        return $this->raza;
    }

    public function setRaza(?Raza $raza): self
    {
        $this->raza = $raza;

        return $this;
    }

    public function getClase(): ?Clase
    {
        return $this->clase;
    }

    public function setClase(?Clase $clase): self
    {
        $this->clase = $clase;

        return $this;
    }

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(string $foto): self
    {
        $this->foto = $foto;

        return $this;
    }
}
