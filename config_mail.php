<?php
// config_mail.php

return [
    'gmail' => [
        'host' => 'smtp.gmail.com',
        'port' => 587,
        'secure' => 'tls',
        'user' => 'rczjunior27@gmail.com',
        'pass' => 'clave_app_gmail',
        'from_email' => 'rczjunior27@gmail.com',
        'from_name' => 'DentoSpark Gmail'
    ],
    'outlook' => [
        'host' => 'smtp.office365.com',
        'port' => 587,
        'secure' => 'tls',
        'user' => 'dento_outlook@outlook.com',
        'pass' => 'clave_app_outlook',
        'from_email' => '178823@upslp.edu.mx',
        'from_name' => 'DentoSpark Outlook'
    ]
];
