<?php
namespace Main\StockManagerBundle\Forms;

use Symfony\Component\Form\FormBuilderInterface;
use Main\StockManagerBundle\StockManagerDTO\UserDTO;
use Symfony\Component\Form\AbstractType;

class InsertIngredientForm extends AbstractType{
	public function buildForm(FormBuilderInterface $builder, array $options){
		$builder->add('ingredientName')
				->add('save', 'submit', array('label' => 'Insert ingredient'));
	}
	
	public function getName()
	{
		return 'ingredient';
	}
}
?>