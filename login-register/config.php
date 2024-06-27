<?php 

$host = 'localhost';
$db = 'pokedex';
$user = 'root';
$password = '';

$url = 'mysql:host=' . $host . ';dbname=' . $db . ';charset=utf8';

try{
    $pdo = new PDO($url, $user, $password);
} catch(PDOException $e){
    print_r($e->getMessage());
}

?>