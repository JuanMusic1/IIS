<?php
include_once("./vendor/autoload.php");
$g = new \Google\Authenticator\GoogleAuthenticator();

$secret = $_GET['secret'];
$codigo = $_GET['code'];

if ($g->checkCode($secret, $codigo)) {
  echo 'Funca!';
} else {
  echo 'Nonas';
}
