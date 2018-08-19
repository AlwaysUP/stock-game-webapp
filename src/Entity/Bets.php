<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BetsRepository")
 */
class Bets
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
    private $userId;

    /**
     * @ORM\Column(type="integer")
     */
    private $stakes;

    /**
     * @ORM\Column(type="string")
     */
    private $position;

    /**
     * @ORM\Column(type="string")
     */
    private $timestamp;

    /**
     * @ORM\Column(type="integer")
     */
    private $stockId;

    public function getId()
    {
        return $this->id;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setStakes($stakes)
    {
        $this->stakes = $stakes;
    }

    public function getStakes()
    {
        return $this->stakes;
    }

    public function setPosition($position)
    {
        $this->position = $position;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }

    public function setStockId($stockId)
    {
        $this->stockId = $stockId;
    }

    public function getStockId()
    {
        return $this->stockId;
    }
}
