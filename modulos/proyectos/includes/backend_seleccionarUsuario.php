<?php
session_start();
if (!isset($_REQUEST) || empty($_REQUEST))
    die("No puedes estar aquí");

require_once "funciones.php";



$_SESSION['id_usuario'] = $_REQUEST["id"];

echo $_SESSION["id_usuario"];