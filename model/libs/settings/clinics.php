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
        'user_id' => array(
            'validations' => array(
                'notEmpty' => 1,
                'numeric' => 1,
            ),
        ),
        'name' => array(
            'validations' => array(
                'notEmpty' => 1,
            ),
        ),
        'desc' => array(
            'validations' => array(
                'notEmpty' => 1,
            ),
        ),
        'doc_name' => array(
            'validations' => array(
                'notEmpty' => 1,
            ),
        ),
        'phone1' => array(
            'validations' => array(
                'notEmpty' => 1,
                'numeric' => 1,
            ),
        ),
        'phone2' => array(
            'validations' => array(
                'notEmpty' => 1,
                'numeric' => 1,
            ),
        ),
        'phone3' => array(
            'validations' => array(
                'notEmpty' => 1,
                'numeric' => 1,
            ),
        ),
        'address' => array(
            'validations' => array(
                'notEmpty' => 1,
            ),
        ),
        'country' => array(
            'validations' => array(
                'notEmpty' => 1,
                'numeric' => 1,
            ),
        ),
        'city' => array(
            'validations' => array(
                'notEmpty' => 1,
                'numeric' => 1,
            ),
        ),
        'region' => array(
            'validations' => array(
                'notEmpty' => 1,
                'numeric' => 1,
            ),
        ),
        'status' => array(
            'validations' => array(
                'notEmpty' => 1,
                'numeric' => 1,
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
