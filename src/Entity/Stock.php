<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StockRepository")
 */
class Stock
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", length=20)
     */
    private $fullName;

    /**
     * @ORM\Column(type="text", length=7)
     */
    private $shortName;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $currPrice;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $lastPrice;

    public function getId()
    {
        return $this->id;
    }

    public function setFullName($fullName){
        $this->fullName = $fullName;
    }

    public function getFullName(){
        return $this->fullName;
    }

    public function setShortName($shortName){
        $this->shortName = $shortName;
    }

    public function getShortName(){
        return $this->shortName;
    }

    public function setCurrPrice($currPrice){
        $this->currPrice = $currPrice;
    }

    public function getCurrPrice(){
        return $this->currPrice;
    }

    public function setLastPrice($lastPrice){
        $this->lastPrice = $lastPrice;
    }

    public function getLastPrice(){
        return $this->lastPrice;
    }
}
