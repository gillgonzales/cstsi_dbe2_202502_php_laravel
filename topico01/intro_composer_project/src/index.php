<?php
require "../vendor/autoload.php";

// echo __DIR__;
// $dotenv = Dotenv\Dotenv::createImmutable(__DIR__."/../");
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// var_dump($dotenv);

echo "<hr>";

var_dump($_ENV['SECRET_KEY']);