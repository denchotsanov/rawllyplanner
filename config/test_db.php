<?php
$db = require __DIR__ . '/db.php';
// test database! Important not to run tests on production or development databases
$db = [
    'dsn'=>'mysql:host=localhost;dbname=yii2_basic_tests',
    'username' => 'rawllybg_calc',
    'password' => 'p{*}?z.K*13C',
    'charset' => 'utf8',
];
return $db;
