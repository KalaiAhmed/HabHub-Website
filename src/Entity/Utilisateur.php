<?php

namespace App\Entity;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 *
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateurRepository")
 *
 */
class Utilisateur implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="idUtilisateur", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idutilisateur;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=30, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=200, nullable=false)
     */
    private $password;

    /**
     * @var int
     *
     * @ORM\Column(name="numTel", type="integer", nullable=false)
     */
    private $numtel;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=15, nullable=false)
     */
    private $type;

    private $roles = [];





    public function getIdutilisateur(): ?int
    {
        return $this->idutilisateur;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getNumtel(): ?int
    {
        return $this->numtel;
    }

    public function setNumtel(int $numtel): self
    {
        $this->numtel = $numtel;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }




    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return 'my-static-salt';
    }

    public function getUsername()
    {
      return (int)$this->getIdUtilisateur();

    }
    public function getRoles(): array
    {
        switch ($this->getType()) {
            case 'A':
                return ['ROLE_ADMIN'];
            default:
                return ['ROLE_USER'];

        }
    }
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }


    public function __toString() {
        return ($this->email.'-'.strval($this->idutilisateur));
    }
}
