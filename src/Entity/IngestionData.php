<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IngestionDataRepository")
 */
class IngestionData
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $timestamp;

    /**
     * @ORM\Column(type="float")
     */
    private $cpu_load;

    /**
     * @ORM\Column(type="integer")
     */
    private $concurrency;

    public function getId()
    {
        return $this->id;
    }

    public function getTimestamp(): ?int
    {
        return $this->timestamp;
    }

    public function setTimestamp(int $timestamp): self
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    public function getCpuLoad(): ?float
    {
        return $this->cpu_load;
    }

    public function setCpuLoad(float $cpu_load): self
    {
        $this->cpu_load = $cpu_load;

        return $this;
    }

    public function getConcurrency(): ?int
    {
        return $this->concurrency;
    }

    public function setConcurrency(int $concurrency): self
    {
        $this->concurrency = $concurrency;

        return $this;
    }
}
