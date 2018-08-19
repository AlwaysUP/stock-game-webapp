<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StatRepository")
 */
class Stat
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
    private $profit;

    /**
     * @ORM\Column(type="integer")
     */
    private $win;

    /**
     * @ORM\Column(type="integer")
     */
    private $loss;

    public function getId()
    {
        return $this->id;
    }

    public function setUserId($userId){
        $this->userId = $userId;
    }

    public function getUserId(){
        return $this->userId;
    }

    public function setProfit($profit){
        $this->profit = $profit;
    }

    public function getProfit(){
        return $this->profit;
    }

    public function setWin($win){
        $this->win = $win;
    }

    public function getWin(){
        return $this->win;
    }

    public function setLoss($loss){
        $this->loss = $loss;
    }

    public function getLoss(){
        return $this->loss;
    }

}

