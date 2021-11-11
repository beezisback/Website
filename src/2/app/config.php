<?php

$config = array(
    'HOST' => '127.0.0.1',
    'USER' => 'root',
    'PASS' => '',
    'DB'   => 'dbname',
    'CORE' => ''
);


// Основные настройки
define('EXPANSION', 2); // 2 = TBC
define('REALMLIST', 'set realmlist login.server.com');

// Настройки Google ReCaptcha v2
define('CAPTCHA_SECRET', '6LcPgbYZAAAAAOYWKZ_vAoBFuStbwzGO_iHCX');
define('CAPTCHA_CLIENT_ID', '6LcPgbYZAAAAAN3Z0v6oBFuSCoBFuSs7Enms');

// Текст после успешной регистрации
define('SUCCESS_MESSAGE', 'Регистрация прошла успешно!');

?>