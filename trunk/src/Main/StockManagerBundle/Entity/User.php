<?php

namespace Main\StockManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 */
class User implements UserInterface, \Serializable
{
    /**
     * @var string
     */
    private $firstname;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var string
     */
    private $email;
    
    /**
     * 
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var integer
     */
    private $id;

     /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $roles;
    
    public function __construct(){
    	$this->roles = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add role
     *
     * @param \Main\StockManagerBundle\Entity\Role $role
     * @return Product
     */
    public function addIdingredient(\Main\StockManagerBundle\Entity\Role $role)
    {
    	$this->roles[] = $role;
    
    	return $this;
    }
    
    /**
     * Remove role
     *
     * @param \Main\StockManagerBundle\Entity\Role $role
     */
    public function removeIdingredient(\Main\StockManagerBundle\Entity\Role $role)
    {
    	$this->idingredient->removeElement($role);
    }
    
    /**
     * Get roles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRoles()
    {
    	$rolesArray = $this->roles->toArray();
    	$stringRoles = array();
    	
    	for($i=0;$i<sizeof($rolesArray);$i++){
    		$stringRoles[$i] = $rolesArray[$i]->getRolename();
    	}
    	
    	return $stringRoles;
    }


    /**
     * Set firstname
     *
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
    
    public function getUsername(){
    	return $this->username;
    }
    
    public function getSalt()
    {
    	return null;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function eraseCredentials()
    {
    }
    
    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
    	return serialize(array(
    			$this->id,
    			$this->username,
    			$this->password,
    			// see section on salt below
    			// $this->salt,
    	));
    }
    
    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
    	list (
    			$this->id,
    			$this->username,
    			$this->password,
    	) = unserialize($serialized);
    }
}
