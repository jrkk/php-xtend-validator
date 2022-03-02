<?php

namespace Xtend\Validator\Constraint;

class Alpha extends BaseConstraint implements Constraint
{
    public function assertion(mixed $actual, mixed $expected = null): Constraint
    {
        $this->valid = is_scalar($actual) && is_string($actual) && preg_match('/^[a-zA-Z]*$/', $actual);
        return $this;
    }
}