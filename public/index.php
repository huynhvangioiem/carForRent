<?php
session_start();
use Tlait\CarForRent\Application\Application;

require __DIR__ . '/../vendor/autoload.php';

$application = new Application();
$application->start();
