<?php

namespace Xtend\Validator\Constraint;

class Numeric extends BaseConstraint
{
    public function assertion(mixed $actual, mixed $expected = null): Constraint
    {
        $this->valid = is_scalar($actual) && is_numeric($actual) && preg_match('/\d+/', $actual);
        return $this;
    }
}