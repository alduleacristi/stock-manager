<?php
namespace Main\StockManagerBundle\Forms;

use Symfony\Component\Form\FormBuilderInterface;
use Main\StockManagerBundle\StockManagerDTO\ProductDTO;
use Symfony\Component\Form\AbstractType;

class InsertProductForm extends AbstractType{
	public function buildForm(FormBuilderInterface $builder, array $options){
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
				'choices' => array('m' => 'Male', 'f' => 'Female')
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