<?php

return [
    "mail" => [
        "originEmail" => "email-origem@gmail.com",
        "originName" => "nome-origem",
        "smtpOptions" => [
            'name' => 'smtp.gmail.com',
            'host' => "smtp.gmail.com",
            'port' => 587,
            'connection_class' => 'login',
            'connection_config' => [
                'username' => 'emailorigem@gmail.com',
                'password' => 'yyyyyy',
                'ssl' => 'tls',
                'host'=>'localhost:8080',
            ]
        ],
        "destinationEmail" => "email-destino@hotmail.com",
        "destinationName" => "nome-destino"
    ]
];
