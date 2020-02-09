<?php
include_once("./vendor/autoload.php");
$g = new \Google\Authenticator\GoogleAuthenticator();

//$username = "juanc";
//$salt = '7WAO342QFANY6IKBF7L7SWEUU79WL3VMT920VB5NQMW';
//$secret = $username.$salt;
$secret = $g->generateSecret();
//echo '<img src="'.$g->getURL($username, 'example.com', $secret).'" />';
echo '<img src="'.$g->getURL("JuanMusic1", 'eia.edu.co', $secret).'"/>';
echo '<br>';
echo "Secret:$secret";

?>

