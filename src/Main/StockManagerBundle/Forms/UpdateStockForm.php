<?php
namespace Main\StockManagerBundle\Forms;

use Symfony\Component\Form\FormBuilderInterface;
use Main\StockManagerBundle\StockManagerDTO\ProductDTO;
use Symfony\Component\Form\AbstractType;

class UpdateStockForm extends AbstractType{
	public function buildForm(FormBuilderInterface $builder, array $options){
		$builder->add('pieces')
				->add('save', 'submit', array('label' => 'Update stock'));
	}
	
	public function getName()
	{
		return 'product';
	}
}
?>