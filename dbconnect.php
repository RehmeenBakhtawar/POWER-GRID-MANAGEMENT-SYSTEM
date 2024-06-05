<?php
$server="localhost";
$username="root";
$password="";
$database="dept_reporting";
$charset = 'utf8mb4';

$conn=mysqli_connect($server,$username,$password,$database);
if(!$conn)
{
    die("error". mysqli_connect_error());
}
$dsn = "mysql:host=$server;dbname=$database;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}
?>