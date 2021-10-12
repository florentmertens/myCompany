<?php

class Employee
{
    // Property
    private int $noEmployee;
    private string $lastName;
    private string $firstName;
    private string $dateBirth;
    private string $job;
    private ?int $noManager;
    private string $hiringDate;
    private float $salary;
    private string $role;
    private ?int $noService;

    // Constructor
    public function __construct($lastName, $firstName, $dateBirth, $job, $noManager, $hiringDate, $salary, $role, $noService)
    {
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->dateBirth = $dateBirth;
        $this->job = $job;
        $this->noManager = $noManager;
        $this->hiringDate = $hiringDate;
        $this->salary = $salary;
        $this->role = $role;
        $this->noService = $noService;
    }

    // Getter & setter noEmployee
    public function getNoEmployee(): int
    {
        return $this->noEmployee;
    }

    public function setNoEmployee(?int $noEmployee): self
    {
        $this->noEmployee = $noEmployee;

        return $this;
    }

    // Getter & setter lastName
    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    // Getter & setter FirstName
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    // Getter & setter DateBirth
    public function getDateBirth(): string
    {
        return $this->dateBirth;
    }

    public function setDateBirth(string $dateBirth): self
    {
        $this->dateBirth = $dateBirth;

        return $this;
    }

    // Getter & setter Job
    public function getJob(): string
    {
        return $this->job;
    }

    public function setJob(string $job): self
    {
        $this->job = $job;

        return $this;
    }

    // Getter & setter NoManager
    public function getNoManager(): ?int
    {
        return $this->noManager;
    }

    public function setNoManager(?int $noManager): self
    {
        $this->noManager = $noManager;

        return $this;
    }

    // Getter & setter HiringDate
    public function getHiringDate(): string
    {
        return $this->hiringDate;
    }

    public function setHiringDate(string $hiringDate): self
    {
        $this->hiringDate = $hiringDate;

        return $this;
    }

    // Getter & setter Salary
    public function getSalary(): float
    {
        return $this->salary;
    }

    public function setSalary(float $salary): self
    {
        $this->salary = $salary;

        return $this;
    }

    // Getter & setter Role
    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    // Getter & setter NoService
    public function getNoService(): ?int
    {
        return $this->noService;
    }

    public function setNoService(?int $noService): self
    {
        $this->noService = $noService;

        return $this;
    }
}
