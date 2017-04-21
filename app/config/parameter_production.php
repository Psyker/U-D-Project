<?php
$db = parse_url(getenv('DB_URL'));

$container->setParameter('database_driver', 'pdo_mysql');
$container->setParameter('database_host', $db['host']);
$container->setParameter('database_port', $db['port']);
$container->setParameter('database_name', substr($db["path"], 1));
$container->setParameter('database_user', $db['user']);
$container->setParameter('database_password', $db['pass']);
$container->setParameter('secret', getenv('SECRET'));
$container->setParameter('locale', 'en');
$container->setParameter('mailer_transport', getenv('mailer_transport'));
$container->setParameter('mailer_host', null);
$container->setParameter('usermail', getenv('testmail'));
$container->setParameter('passwordmail', getenv('testpassword'));