<?php

namespace App\Entity;
use Datetime;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $lastname;

    #[ORM\Column(length: 20)]
    private ?string $firstname;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $username = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email;

    /**
     * @ORM\Column(type="json_array")
     */
    // private $roles = array();
    #[ORM\Column]
    private array $roles = [];
    
    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 6)]    
    private ?int $token;

    #[ORM\Column(length: 15, nullable: true)]    
    private ?string $mobile;
    
    #[ORM\Column(length: 3)]
    private ?int $isactivated;
    
    #[ORM\Column(length: 3)]
    private ?int $isblocked;

    #[ORM\Column(length: 999, nullable:true)]
    private ?string $secretkey = null;

    #[ORM\Column(nullable: true)]
    private ?int $mailtoken;

    #[ORM\Column(length: 255)]
    private ?string $qrcodeurl;

    #[ORM\Column(length: 255)]
    private ?string $userpic;

    // #[Column(type='datetime')]
    #[ORM\Column(type: 'datetime')]
    private DateTime $created_at;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?DateTime $updated_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $role = [];

        // $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';
        if (empty($roles)){
            $role = ['ROLE_USER'];
        }
        return $role;
        // return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
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

    public function getMobile(): ?string
    {
        return $this->mobile;
    }

    public function setMobile(?string $mobile): self
    {
        $this->mobile = $mobile;

        return $this;
    }

    public function getSecretkey(): array
    {
        return $this->secretkey;
    }

    public function setSecretkey(?array $secretkey): self
    {
        $this->secretkey = $secretkey;

        return $this;
    }

    public function getMailtoken(): ?int
    {        
        return $this->mailtoken;
    }

    public function setMailtoken(?int $mailtoken): self
    {
        $this->mailtoken = $mailtoken;

        return $this;
    }

    public function getQrcodeurl(): ?string
    {
        return $this->qrcodeurl;
    }

    public function setQrcodeurl(?string $qrcodeurl): self
    {
        $this->qrcodeurl = $qrcodeurl;

        return $this;
    }

    public function getIsactivated(): ?int
    {
        return $this->isactivated;
    }

    public function setIsactivated(?int $isactivated): self
    {
        $this->isactivated = $isactivated;

        return $this;
    }

    public function getToken(): ?int
    {
        return $this->token;
    }

    public function setToken(?int $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getUserpic(): ?string
    {
        return $this->userpic;
    }

    public function setUserpic(?string $userpic): self
    {
        $this->userpic = $userpic;

        return $this;
    }

    public function getIsblocked(): ?int
    {
        return $this->isblocked;
    }

    public function setIsblocked(?int $isblocked): self
    {
        $this->isblocked = $isblocked;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        $this->plainPassword = null;
        $this->setUsername = null;
        $this->setPassword = null;

    }
}
