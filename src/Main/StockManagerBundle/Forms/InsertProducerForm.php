<?php
namespace Main\StockManagerBundle\Forms;

use Symfony\Component\Form\FormBuilderInterface;
use Main\StockManagerBundle\StockManagerDTO\ProducerDTO;
use Symfony\Component\Form\AbstractType;

class InsertProducerForm extends AbstractType{
	public function buildForm(FormBuilderInterface $builder, array $options){
		$builder->add('producerName')
		->add('adress')
		->add('email')
		->add('url')
		->add('phone')
		->add('save', 'submit', array('label' => 'Submit'));
	}

	public function getName()
	{
		return 'producer';
	}
}
?>