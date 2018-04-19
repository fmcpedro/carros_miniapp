<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;


class ValidNameValidator extends ConstraintValidator
{
  public function validate($value, Constraint $constraint)
    {
        if (!preg_match('/^[a-zA-Z]+$/', $value, $matches)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }
    }
        
        

        

    }
    
    
    
  