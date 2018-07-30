<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
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

    /**
     * @ORM\Column(type="string")
     */
    private $roles;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $plainPassword;

    public function getId()
    {
        return $this->id;
    }
    
    public function getFullName()
    {
        return $this->fullName;
    }
    
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }

    public function getPassword()
    {
        return $this->password;
    }
    
    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    public function getStreet()
    {
        return $this->street;
    }
    
    public function setStreet($street)
    {
        $this->street = $street;
    }

    public function getCity()
    {
        return $this->city;
    }
    
    public function setCity($city)
    {
        $this->city = $city;
    }

    public function getZip()
    {
        return $this->zip;
    }
    
    public function setZip($zip)
    {
        $this->zip = $zip;
    }

    public function getPaypal()
    {
        return $this->paypal;
    }
    
    public function setPaypal($paypal)
    {
        $this->paypal = $paypal;
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

    public function setRoles($roles){
        $this->roles = $roles;
    }
    public function getRoles(){
        return [$this->roles];
    }
    
    public function getSalt(){

    }
    
    public function setUsername($username){
        $this->username = $username;
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
            $this->roles,
            $this->fullName,
            $this->street,
            $this->city,
            $this->zip,
            $this->paypal
        ]);
    }

    public function unserialize($string){
        list(
            $this->id,
            $this->username,
            $this->email,
            $this->password,
            $this->roles,
            $this->fullName,
            $this->street,
            $this->city,
            $this->zip,
            $this->paypal
        ) = unserialize($string, ['allowed_classes'=>false]);
    }

    // create User object
    public function createUser($email, $password, $roles){
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setUsername($email);
        $this->setRoles($roles);
    }
}
