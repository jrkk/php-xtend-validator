<?php

namespace Xtend\Validator\Constraint;

interface Constraint 
{
    const ERROR_MESSAGE = "%s is not valid";
    public function setMessage(string $message): Constraint;
    public function getMessage(): string;
    public function assertion(mixed $actual, mixed $expected = null): Constraint;
    public function isValid(): bool;
}