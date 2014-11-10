<?php
namespace Main\StockManagerBundle\Validator\Constraints;
 
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\MissingOptionsException;
 
/**
 * @Annotation
 */
class DateGreatThanActual extends Constraint
{
    public $minMessage = 'This date should be great than actual date.';

    public function validatedBy() {
         return get_class($this).'Validator';
    }
}