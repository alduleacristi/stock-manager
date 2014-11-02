<?php
namespace Main\StockManagerBundle\Forms;

use Symfony\Component\Form\FormBuilderInterface;
use Main\StockManagerBundle\StockManagerDTO\UserDTO;
use Symfony\Component\Form\AbstractType;

class InsertCategoryForm extends AbstractType{
	public function buildForm(FormBuilderInterface $builder, array $options){
		$builder->add('firstName')
				 ->add('save', 'submit', array('label' => 'Insert category'));
	}
	
	public function getName()
	{
		return 'user';
	}
}
?>