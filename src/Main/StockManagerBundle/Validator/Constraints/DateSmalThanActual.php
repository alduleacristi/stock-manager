<?php
namespace Main\StockManagerBundle\Validator\Constraints;
 
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\MissingOptionsException;
 
/**
 * @Annotation
 */
class DateSmalThanActual extends Constraint
{
    public $maxMessage = 'This date should be less than actual date.';

    public function validatedBy() {
         return get_class($this).'Validator';
    }
}