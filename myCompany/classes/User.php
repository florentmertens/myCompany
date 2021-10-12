<?php

class User
{
    // Property
    private int $idUser;
    private string $pseudo;
    private string $email;
    private string $password;
    private int $noEmployee;

    // Constructor
    public function __construct($pseudo, $email, $password, $noEmployee)
    {
        $this->pseudo = $pseudo;
        $this->email = $email;
        $this->password = $password;
        $this->noEmployee = $noEmployee;
    }

    // Getter IdUser
    public function getIdUser(): int
    {
        return $this->idUser;
    }

    public function setIdUser(int $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

    // Getter & setter Pseudo
    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    // Getter & setter Email
    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    // Getter & setter Password
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    // Getter NoEmployee
    public function getNoEmployee(): int
    {
        return $this->noEmployee;
    }

    public function setNoEmployee(int $noEmployee): self
    {
        $this->noEmployee = $noEmployee;

        return $this;
    }
}
