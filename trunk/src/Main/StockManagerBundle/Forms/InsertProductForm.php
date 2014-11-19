<?php
namespace Main\StockManagerBundle\Forms;

use Symfony\Component\Form\FormBuilderInterface;
use Main\StockManagerBundle\StockManagerDTO\ProductDTO;
use Symfony\Component\Form\AbstractType;

class InsertProductForm extends AbstractType{
	private $categoryService;
	private $producerService;
	
	public function __construct($categoryService,$producerService){
		$this->categoryService = $categoryService;
		$this->producerService = $producerService;
	}
	
	public function buildForm(FormBuilderInterface $builder, array $options){
		$categorys = $this->categoryService->getAllCategory();
		$arrayCategory = array();
		for($i=0;$i<sizeof($categorys);$i++){
			$arrayCategory[$categorys[$i]->getId()] = $categorys[$i]->getCategoryname();
		}
		
		$producers = $this->producerService->getAllProducers();
		$arrayProducer = array();
		for($i=0;$i<sizeof($producers);$i++){
			$arrayProducer[$producers[$i]->getId()] = $producers[$i]->getProducername();
		}
		
		$builder->add('productName')
		->add('productPrice')
		->add('productAddition')
		->add('manufactureDate','date',array(
				'input' => 'datetime',
				'widget' => 'choice'
		))
		->add('expiringDate','date',array(
				'input' => 'datetime',
				'widget' => 'choice'
		))
		->add('category', 'choice', array(
				'empty_value' => 'Select a category',
				'choices' => $arrayCategory
		))
		->add('producer', 'choice', array(
				'empty_value' => 'Select a producer',
				'choices' => $arrayProducer
		))
		->add('description', 'textarea')
		->add('save', 'submit', array('label' => 'Insert product'));
	}

	public function getName()
	{
		return 'product';
	}
}
?>