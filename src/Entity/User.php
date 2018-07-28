<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type="text", length=200, nullable=true)
     */
    private $fullName;
    
    /**
     * @ORM\Column(type="text", length=255)
     */
    private $password;
    
    /**
     * @ORM\Column(type="text", length=255, nullable=true)
     */
    private $street;
    
    /**
     * @ORM\Column(type="text", length=255, nullable=true)
     */
    private $city;
    
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $zip;
    
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $paypal;
    
    /**
     * @ORM\Column(type="text")
     */
    private $email;

    /**
     * @ORM\Column(type="text")
     */
    private $username;

    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getFullName()
    {
        return $this->fullName;
    }
    
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }
    
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function getStreet()
    {
        return $this->street;
    }
    
    public function setStreet($street)
    {
        $this->street = $street;
        return $this;
    }

    public function getCity()
    {
        return $this->city;
    }
    
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    public function getZipCode()
    {
        return $this->zip;
    }
    
    public function setZipCode($zip)
    {
        $this->zip = $zip;
        return $this;
    }

    public function getPaypal()
    {
        return $this->paypal;
        return $this;
    }
    
    public function setPaypal($paypal)
    {
        $this->paypal = $paypal;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }
    
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getRoles(){
        return [
            'ROLE_USER'
        ];
    }
    
    public function getSalt(){

    }
    
    public function setUsername($username){
        $this->username = $username;
        return $this;
    }

    public function getUsername(){
        return $this->username;
    }

    public function eraseCredentials(){

    }

    public function serialize(){
        return serialize([
            $this->id,
            $this->username,
            $this->email,
            $this->password,
        ]);
    }

    public function unserialize($string){
        list(
            $this->id,
            $this->username,
            $this->email,
            $this->password
        ) = unserialize($string, ['allowed_classes'=>false]);
    }
}
