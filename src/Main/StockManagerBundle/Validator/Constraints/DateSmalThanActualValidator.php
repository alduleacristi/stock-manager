<?php
namespace Main\StockManagerBundle\Validator\Constraints;
 
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
 
class DateSmalThanActualValidator extends ConstraintValidator
{
	public function validate($value, Constraint $constraint)
	{
		if($value > new \DateTime("today")){
			$this->context->buildViolation($constraint->maxMessage)
				->addViolation();
		}
	}
}