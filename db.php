<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$host = 'MySQL-8.0';
$user = 'root';
$password = '';
$dbname = 'students_db.';

try {
    $conn = new mysqli($host, $user, $password, $dbname);
    $conn->set_charset('utf8mb4');
} catch (mysqli_sql_exception $e) {
    exit('Ошибка подключения к БД: ' . $e->getMessage());
}