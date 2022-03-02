<?php

namespace Xtend\Validator;

use Xtend\Validator\Constraint\Constraint;

class Validator 
{
    protected Container $rules;
    protected Container $errors;

    function __construct(
        protected array $data = [],
        protected bool $valid = true
    ) {
        $this->rules = new Container();
        $this->errors = new Container();
    }

    public function showErrors(): array 
    {
        return $this->errors->all();
    }

    public function reset(): Validator
    {
        $this->rules->flush();
        $this->errors->flush();
        return $this;
    }

    public function constraints(array $rules, array $labels = []): Validator
    {
        foreach($rules as $attribute => $config) {
            $this->rules->set($attribute, array_reduce($config, function($constraints, $rule) use ($attribute, $labels) {
                if($rule instanceof Constraint) {
                    $constraints[] = $rule;
                } else if(is_countable($rule) && count($rule) > 0) {
                    [ $constraint ] = $rule;
                    $constraints[] = $constraint->constraint(...array_merge([($labels[$attribute] ?? $attribute)], array_splice($rule, 1, count($rule))));
                }
                return $constraints;
            }, []));
        }
        return $this;
    }

    public function validate() : bool
    {
        foreach($this->rules->all() as $attribute => $constraints) {
            foreach($constraints as $constraint) {
                $validate = match(get_class($constraint)) {
                    Rules::Required->value => $constraint->assertion($attribute, array_keys($this->data)),
                    Rules::Alpha->value,
                    Rules::AlphaDash->value,
                    Rules::AlphaSpace->value,
                    Rules::AlphaNumeric->value,
                    Rules::AlphaNumericDash->value,
                    Rules::AlphaNumericSpace->value,
                    Rules::Integer->value,
                    Rules::Numeric->value => $constraint->assertion($this->data[$attribute]),
                    Rules::Contains->value => $constraint->assertion($this->data[$attribute], $constraint->getOptions()),
                    Rules::MinLength->value => $constraint->assertion($this->data[$attribute], $constraint->getOption('minLength')),
                    Rules::MaxLength->value => $constraint->assertion($this->data[$attribute], $constraint->getOption('maxLength')),
                    Rules::ExactLength->value => $constraint->assertion($this->data[$attribute], $constraint->getOption('exactLength')),
                    Rules::Min->value => $constraint->assertion($this->data[$attribute], $constraint->getOption('min')),
                    Rules::Max->value => $constraint->assertion($this->data[$attribute], $constraint->getOption('max'))
                };
                if(!$validate->isValid()) {
                    $this->valid = false;
                    $errors = [];
                    if($this->errors->has($attribute)) {
                        $errors = $this->errors->get($attribute);
                    } 
                    $errors[] = $validate->getMessage();
                    $this->errors->set($attribute, $errors);
                }
            }
        }
        return $this->valid;
    }
}