<?php
namespace Main\StockManagerBundle\StockManagerDTO;

use Symfony\Component\Validator\Constraints as Assert;

class ProducerDTO{
	
	/**
	 * @Assert\NotBlank
	 * @Assert\Length(
	 * 	  min = 3,
	 * 	  max = 15,
	 *    minMessage = "The category name must have at least 3 characters",
	 *    maxMessage = "The category name can have maximum 15 characters"
	 * ) 	
	 * 
	 */
	private $producerName;
	
	/**
	 * @Assert\NotBlank
	 * @Assert\Length(
	 * 	  max = 100,
	 *    maxMessage = "The category name can have maximum 100 characters"
	 * ) 	
	 */
	private $adress;
	
	/**
	 * @Assert\NotBlank
	 * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     * )
     * * @Assert\Length(
	 * 	  min = 3,
	 * 	  max = 25,
	 *    minMessage = "The category name must have at least 3 characters",
	 *    maxMessage = "The category name can have maximum 25 characters"
	 * ) 	
	 */
	private $email;
	
	private $url;
	private $phone;

	public function __get($name){
		return $this->$name;
	}
	
	public function __set($name,$value){
		$this->$name = $value;
	}
}
?>