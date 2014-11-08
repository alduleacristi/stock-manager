<?php
namespace Main\StockManagerBundle\StockManagerDTO;

use Symfony\Component\Validator\Constraints as Assert;

class ProducerDTO{
	private $name;

	public function __get($name){
		return $this->$name;
	}
	
	public function __set($name,$value){
		$this->$name = $value;
	}
}
?>