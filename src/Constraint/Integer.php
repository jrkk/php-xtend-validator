<?php

namespace Xtend\Validator\Constraint;

class Integer extends BaseConstraint
{
    public function assertion(mixed $actual, mixed $expected = null): Constraint
    {
        $this->valid = is_scalar($actual) &&  is_int($actual) && preg_match('/\d+/', $actual);
        return $this;
    }
}