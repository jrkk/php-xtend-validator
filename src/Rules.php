<?php

namespace Xtend\Validator;

use Xtend\Validator\Constraint\Alpha;
use Xtend\Validator\Constraint\AlphaDash;
use Xtend\Validator\Constraint\AlphaNumeric;
use Xtend\Validator\Constraint\AlphaNumericDash;
use Xtend\Validator\Constraint\AlphaNumericSpace;
use Xtend\Validator\Constraint\AlphaSpace;
use Xtend\Validator\Constraint\Constraint;
use Xtend\Validator\Constraint\Contains;
use Xtend\Validator\Constraint\ExactLength;
use Xtend\Validator\Constraint\Integer;
use Xtend\Validator\Constraint\Max;
use Xtend\Validator\Constraint\MaxLength;
use Xtend\Validator\Constraint\Min;
use Xtend\Validator\Constraint\MinLength;
use Xtend\Validator\Constraint\Numeric;
use Xtend\Validator\Constraint\Required;

enum Rules: string
{
    case Required = Required::class;
    case Alpha = Alpha::class;
    case AlphaDash = AlphaDash::class;
    case AlphaSpace = AlphaSpace::class;
    case AlphaNumeric = AlphaNumeric::class;
    case AlphaNumericDash = AlphaNumericDash::class;
    case AlphaNumericSpace = AlphaNumericSpace::class;
    case Numeric = Numeric::class;
    case Integer = Integer::class;
    case Contains = Contains::class;
    case MinLength = MinLength::class;
    case MaxLength = MaxLength::class;
    case ExactLength = ExactLength::class;
    case Min = Min::class;
    case Max = Max::class;

    public function constraint(...$args): Constraint
    {
        return new $this->value(...$args);
    }
}