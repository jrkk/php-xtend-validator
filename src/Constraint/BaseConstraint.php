<?php

namespace Xtend\Validator\Constraint;

abstract class BaseConstraint implements Constraint
{
    function __construct(
        protected string $label = '',
        protected string $message = '',
        protected array $options = [],
        protected bool $valid = false
    ) { 
        $this->message = $this->message ?? self::ERROR_MESSAGE;
    }

    public function setMessage(string $message): Constraint
    {
        $this->message = $message;
        return $this;
    }

    public function getMessage(): string 
    {
        $values = [ $this->label, ...array_values($this->options) ];
        return sprintf($this->message, ...$values);
    }

    public function setLabel(string $label): Constraint
    {
        $this->label = $label;
        return $this;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setOption(string $name, string $option): Constraint
    {
        if(is_scalar($option)) {
            $this->options[$name] = $option;
        }
        return $this;
    }

    public function getOption(string $name): mixed 
    {
        return $this->options[$name] ?? null;
    }

    public function getOptions(): array { return $this->options; }

    public function isValid(): bool { return $this->valid; }

    abstract public function assertion(mixed $actual, mixed $expected = null): Constraint ;
}