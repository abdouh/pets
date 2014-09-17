<?php

//settings for the table 'employees'
//validations contains validation method names and their parameters if they exist

return array(
    'key' => 'emp_id',
    'fields' => array(
        'emp_id' => array(
            'validations' => array(
                'notEmpty' => 1,
                'numeric' => 1,
            ),
        ),
        'emp_name' => array(
            'validations' => array(
                'notEmpty' => 1,
            ),
        ),
        'emp_email' => array(
            'validations' => array(
                'notEmpty' => 1,
                'email' => 1,
            ),
        ),
        'emp_job' => array(
            'validations' => array(
                'notEmpty' => 1,
                'numeric' => 1,
            ),
        ),
        'emp_salary' => array(
            'validations' => array(
                'notEmpty' => 1,
                'decimal' => 1,
            ),
        ),
        'emp_address' => array(
            'validations' => array(
                'notEmpty' => 1,
            ),
        ),
        'emp_married' => array(
            'validations' => array(
                'notEmpty' => 1,
                'numeric' => 1,
            ),
        ),
        'has_kids' => array(
            'validations' => array(
                'notEmpty' => 1,
                'numeric' => 1,
            ),
        ),
        'emp_gender' => array(
            'validations' => array(
                'notEmpty' => 1,
                'numeric' => 1,
            ),
        ),
        'emp_birthdate' => array(
            'validations' => array(
                'notEmpty' => 1,
                'date' => 1,
            ),
        ),
        'emp_certificate' => array(
            'validations' => array(
                'notEmpty' => 1,
            ),
        ),
    ),
);