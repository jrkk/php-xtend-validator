<?php

require_once 'vendor/autoload.php';

use Xtend\Validator\Rules;
use Xtend\Validator\Validator;

$validator = new Validator([
    'name' => 'JrkKiran',
    'age' => 35
]);

$rules = [
    'name' => [
        [Rules::Required, 'Name is required'],
        [Rules::Alpha, 'Name is should use alphabhets only']
    ],
    'age' => [
        [Rules::Required, 'Age is required'],
        [Rules::Numeric, 'Age should be numeric value'],
        [Rules::Min, '%s should be minimum %s', ['min' => 25]]
    ]
];

$rules = [
    'name' => [
        Rules::Required->constraint('User name'),
        Rules::Alpha->constraint('User name')
    ],
    'age' => [
        Rules::Required->constraint('Age'),
        Rules::Numeric->constraint('Age')
    ]
];

if($validator->constraints($rules, ['name' => 'User name', 'age' => 'Age'])->validate()) {
    echo "SUCCESS";
} else {
    var_export($validator->showErrors());
}
