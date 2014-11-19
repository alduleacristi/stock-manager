<?php

namespace Main\StockManagerBundle\Services;

class ProducerService {
	protected $em;
	public function __construct(\Doctrine\ORM\EntityManager $em) {
		$this->em = $em;
	}
	public function insertProducer($producer) {
		$this->em->persist ( $producer );
		$this->em->flush ();
	}
	public function getAllProducers() {
		return $this->em->getRepository ( 'MainStockManagerBundle:Producer' )->findAll ();
	}
	public function getProducerById($idProducer) {
		return $this->em->getRepository ( 'MainStockManagerBundle:Producer' )->find ( $idProducer );
	}
	public function dropProducer($producer) {
		$this->em->remove ( $producer );
		$this->em->flush ();
	}
	
	public function updateProducer($producer){
		$oldProducer = $this->getProducerById($producer->getId());
		
		$oldProducer->setProducername($producer->getProducername());
		$oldProducer->setAdress($producer->getAdress());
		$oldProducer->setEmail($producer->getEmail());
		$oldProducer->setUrl($producer->getUrl());
		$oldProducer->setPhone($producer->getPhone());
		
		$this->em->flush();
	}
}
?>