<?php
namespace Main\StockManagerBundle\Forms;

use Symfony\Component\Form\FormBuilderInterface;
use Main\StockManagerBundle\StockManagerDTO\ProductIngredintDTO;
use Symfony\Component\Form\AbstractType;

class InsertProductIngredientForm extends AbstractType{
	private $ingredientService;
	
	public function __construct($ingredientService){
		$this->ingredientService = $ingredientService;
	}
	
	public function buildForm(FormBuilderInterface $builder, array $options){
		$ingredients = $this->ingredientService->getAllIngredients();
		$arrayIngredient = array();
		for($i=0;$i<sizeof($ingredients);$i++){
			$arrayIngredient[$ingredients[$i]->getId()] = $ingredients[$i]->getIngredientname();
		}
		
		$builder->add('ingredient', 'choice', array(
					'empty_value' => 'Select an ingredient',
					'choices' => $arrayIngredient))
				->add('save', 'submit', array('label' => 'Insert ingredient'));
	}
	
	public function getName()
	{
		return 'ingredient';
	}
}
?>