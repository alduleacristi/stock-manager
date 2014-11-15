<?php

namespace Main\StockManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Producer
 */
class Producer
{
    /**
     * @var string
     */
    private $producername;

    /**
     * @var string
     */
    private $adress;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set producername
     *
     * @param string $producername
     * @return Producer
     */
    public function setProducername($producername)
    {
        $this->producername = $producername;

        return $this;
    }

    /**
     * Get producername
     *
     * @return string 
     */
    public function getProducername()
    {
        return $this->producername;
    }

    /**
     * Set adress
     *
     * @param string $adress
     * @return Producer
     */
    public function setAdress($adress)
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * Get adress
     *
     * @return string 
     */
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Producer
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
     * Set url
     *
     * @param string $url
     * @return Producer
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Producer
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
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
    
    public function setId($id){
    	$this->id = $id;
    	
    	return $this;
    }
}
