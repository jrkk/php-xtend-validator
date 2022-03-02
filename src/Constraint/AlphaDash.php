<?php

namespace Xtend\Validator\Constraint;

class AlphaDash extends BaseConstraint
{

    public function assertion(mixed $actual, mixed $expected = null): Constraint
    {
        $this->valid = is_scalar($actual) && is_string($actual) && preg_match('/^[a-zA-Z\-\_]+$/', $actual);
        return $this;
    }
}