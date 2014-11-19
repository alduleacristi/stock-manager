<?php
namespace Main\StockManagerBundle\Services;

class CategoryService{
	protected $em;
	
	public function __construct(\Doctrine\ORM\EntityManager $em)
	{
		$this->em = $em;
	}
	
	public function insertCategory($category){
		$this->em->persist($category);
		$this->em->flush();
	}
	
	public function getAllCategory(){
		return $this->em->getRepository('MainStockManagerBundle:Category')->findAll();
	}
	
	public function getCategoryById($idcategory){
		return $this->em->getRepository('MainStockManagerBundle:Category')->find($idcategory);
	}
	
	public function dropCategory($category) {
		$this->em->remove ( $category );
		$this->em->flush ();
	}
}
?>