<?php
$url = "http://52.186.69.40/otrs/nph-genericinterface.pl/Webservice/GenericTicketConnector";  // URL for OTRS server
$namespace = "http://52.186.69.40/otrs/TicketConnector"; //Namespace in Webservice Configuration
$username = "jorge";
$password = "nitales"; 
$typeID = 2; // id from ticket_type table
$queueID = 2; // id from queue table
$priorityID = 1; // id from ticket_priority table
$ownerID = 1; // id from users table
// $title = $_POST[title];
$title = "Titulo";
// $severity = $_POST[severity];
$severity = "Severo moreno";
$description = "First Name: " . $_POST [cust_fn] . "\n" . 
			"Last Name: " . $_POST [cust_ln] . "\n" .
			"Company Name: " . $_POST [cust_cn] . "\n" .
			"Phone Number: " . $_POST [cust_pn] . "\n" .
			"Product: " . $_POST [cpcprs] . "\n" .
			"Version: " . $_POST [cpcpv] . "\n" .
			"Type: " . $_POST [cpcpt] . "\n" .
			"Issue: " . $_POST [title] . "\n" .
			"Description: " . $_POST[description] ;
// $email = $_POST[cust_ema];
$email = "correp@nitales.nano";
// $queue = $_POST[cpcprs];
$queue = "Colita esta";
$Operation = "TicketCreate";

$XMLData=array("UserLogin", $username,);

$client = new \SoapClient(
	null, 
	array(
		'location'  => $url,
		'uri'       => $namespace,
		'trace'     => 1,
		'style'     => SOAP_RPC,
		'use'       => SOAP_ENCODED,
	)
);

$msg=array(new SoapParam($username, 'ns1:UserLogin'),
		   new SoapParam($password, 'ns1:password'),
		   new SoapParm(Array(
				'CustomerUser'=> $from,
				'PriorityID'=> $priorityID,
				'Queue'=> $queue,
				'State'=> 'new',
				'Title'=> $title,
				), 'ns1:Ticket'),
			new SoapParam(Array(
			'Body'=> $description,
			'ContentType'=> 'text/plain; charset=ISO-8859-1',
			'Subject'=> $title,
			),'ns1:Article'),
);

$answer = $client->_soapCall('TicketCreate',$msg);
print_r($answer);

?>
