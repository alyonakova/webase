<?php
require_once dirname(dirname(__FILE__)) . "/config/database.php";
// FIXME: Notice'ов быть вообще не должно, это приказ
error_reporting(E_ALL & ~E_NOTICE);

$DB = new mysqli($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
if (mysqli_connect_errno()) {
    printf("Соединение не установлено", mysqli_connect_errno());
    exit();
}
$DB->set_charset('utf8');

function closeDatabaseConnection()
{
    global $DB;
    $DB->close();
}

function hash_credentials($login, $password)
{
    return hash('sha3-512', $login . ':' . $password);
}

register_shutdown_function('closeDatabaseConnection');
