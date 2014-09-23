<?php

//settings for the table 'employees'
//validations contains validation method names and their parameters if they exist

return array(
    'key' => 'id',
    'fields' => array(
        'id' => array(
            'validations' => array(
                'notEmpty' => 1,
                'numeric' => 1,
            ),
        ),
        'email' => array(
            'validations' => array(
                'notEmpty' => 1,
                'email' => 1,
            ),
        ),
        'username' => array(
            'validations' => array(
                'notEmpty' => 1,
            ),
        ),
        'password' => array(
            'validations' => array(
                'notEmpty' => 1,
            ),
        ),
        'time_added' => array(
            'validations' => array(
                'notEmpty' => 1,
                'numeric' => 1,
            ),
        ),
        'date_added' => array(
            'validations' => array(
                'notEmpty' => 1,
                'numeric' => 1,
            ),
        ),
    ),
);