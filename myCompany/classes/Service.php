<?php

class Service
{
    // Property
    private int $noService;
    private string $name;
    private string $city;

    // Constructor
    public function __construct($name, $city)
    {
        $this->name = $name;
        $this->city = $city;
    }

    // Getter & setter noService
    public function getNoService(): int
    {
        return $this->noService;
    }

    public function setNoService(int $noService): self
    {
        $this->noService = $noService;

        return $this;
    }

    // Getter & setter Name
    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    // Getter & setter City
    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }
}
