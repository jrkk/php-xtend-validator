<?php

namespace Xtend\Validator\Constraint;

class Contains extends BaseConstraint
{
    public function assertion(mixed $actual, mixed $expected = null): Constraint
    {
        if(is_scalar($actual)
            && is_array($expected) 
            && is_countable($expected) 
            && count($expected) > 0) {
            $this->valid = in_array($actual, $expected);
        }
        return $this;
    }
}