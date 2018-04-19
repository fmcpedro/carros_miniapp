<?php
namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;


class ValidName extends Constraint
{
    public $message = 'O nome introduzido não é válido.';

}