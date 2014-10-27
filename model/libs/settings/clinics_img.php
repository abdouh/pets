<?php

//settings for the table 'employees'
//validations contains validation method names and their parameters if they exist

return array(
    'key' => 'clinic_id',
    'fields' => array(
        'id' => array(
            'validations' => array(
                'notEmpty' => 1,
                'numeric' => 1,
            ),
        ),
        'clinic_id' => array(
            'validations' => array(
                'notEmpty' => 1,
                'numeric' => 1,
            ),
        ),
        'img_name' => array(
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