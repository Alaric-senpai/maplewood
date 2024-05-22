<?php
session_start();

$server = "localhost";
$username = "root";
$password = "";
$database = "Maplewood";

$conn = new mysqli($server, $username, $password, $database);
