<?php

class User
{
    private ?\DateTimeImmutable $createdAt;

    public function __construct(
        private readonly string $login,
        private readonly string $password,
        private readonly string $passwordConfirmation,
        private readonly string $address,
        private readonly string $email,
        private readonly string $number,
        $createdAt = null 
    )
    {
        $this->createdAt = $createdAt;
        if (null === $this -> createdAt){
            $this -> createdAt = new \DateTimeImmutable();
        }

    }

    public function getLogin(): string
    {
        return strtolower($this->login);
    }

    
    public function getPassword(): string
    {
        return $this->password;
    }

    public function getPasswordConfirmation(): string
    {
        return $this->$passwordConfirmation;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getNumber(): string
    {
        return $this->number;
    }


    public function isPassworsEquals(): bool
    {
        return sha1($this->password) === sha1($this->passwordConfirmation);
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

}