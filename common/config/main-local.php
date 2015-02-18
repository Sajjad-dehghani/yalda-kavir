<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=bcolfdqn_93Yalda',
            'username' => 'bcolfdqn_Mipo14k',
            'password' => '2h8gSR[*!ego17FkJ[',
            'charset' => 'utf8',
            'tablePrefix' => 'exn8o_',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
    ],
];
