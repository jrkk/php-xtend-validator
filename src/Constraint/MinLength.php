<?php

namespace Xtend\Validator\Constraint;

class MinLength extends BaseConstraint implements Constraint
{
    public function assertion(mixed $actual, mixed $expected = null): Constraint
    {
        if(!is_scalar($actual) || !is_scalar($expected)) {
            return $this;
        }
        $this->valid = is_numeric($expected) && is_string($actual) && strlen($actual) >=  $expected;
        return $this;
    }
}