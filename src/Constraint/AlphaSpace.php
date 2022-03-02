<?php

namespace Xtend\Validator\Constraint;

class AlphaSpace extends BaseConstraint
{
    public function assertion(mixed $actual, mixed $expected = null): Constraint
    {
        $this->valid = is_scalar($actual) && is_string($actual) && preg_match('/^[a-zA-Z\s]+$/', $actual);
        return $this;
    }
}