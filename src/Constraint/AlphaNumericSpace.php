<?php

namespace Xtend\Validator\Constraint;

class AlphaNumericSpace extends BaseConstraint
{
    public function assertion(mixed $actual, mixed $expected = null): Constraint
    {
        $this->valid = is_scalar($actual) && preg_match('/^[a-zA-Z0-9\s]+$/', $actual);
        return $this;
    }
}