<?php

$url      = "http://http://137.117.47.67/otrs/rpc.pl";  // URL for OTRS server
$username = "jorge";  // SOAP username set in sysconfig
$password = "nitales";  // SOAP password set in sysconfig  

$typeID = 2; // id from ticket_type table
$queueID = 2; // id from queue table
$priorityID = 1; // id from ticket_priority table
$ownerID = 2; // id from users table


// Form Fields(Your Ticket Form fields)

$username = $_POST['username_id'];
$queueID = $_POST['queue'];
$issue_type = $_POST['issue_type'];
$subject = $_POST['subject'];
$title = $username.'-Issue With'.' '.$issue_type.' -'.$subject;
$description = $_POST['description'];
$category = $_POST['category'];
$priorityID = $_POST['priority'];


/// Initialize new client session
$client = new SoapClient(
    null,
    array(
        'location'  => $url,
        'uri'       => "Core",
        'trace'     => 1,
        'login'     => $username,
        'password'  => $password,
        'style'     => SOAP_RPC,
        'use'       => SOAP_ENCODED
    )
);

/// Create a new ticket shell. The function returns the Ticket ID     
$TicketID = $client->__soapCall(
    "Dispatch", array($username, $password,
        "TicketObject", "TicketCreate",
        "Title",        $title,
        "TypeID",   $typeID,
        "QueueID",   $queueID,
        "LockID",  1,
        "PriorityID",   $priorityID,
        "State",        "new",
        "CustomerUser", $username,
        "OwnerID",      $ownerID,
        "UserID",       1,
    )
);



/// Create an article with the info. The function returns an Article ID ///
$ArticleID = $client->__soapCall("Dispatch",
    array($username, $password,
        "TicketObject",   "ArticleCreate",
        "TicketID",       $TicketID,
        "ArticleType",    "webrequest",
        "SenderType",     "customer",
        "HistoryType",    "WebRequestCustomer",
        "HistoryComment", "created from PHP",
        "From",           $username,
        "Subject",        $title,
        "ContentType",    "text/plain; charset=ISO-8859-1",
        "Body",           $description,
        "UserID",         1,
        "Loop",           0,
        "AutoResponseType", 'auto reply',
        "OrigHeader", array(
        'From' => $username,
        'To' => 'Postmaster',
        'Subject' => $title,
        'Body' => $description
    ),
    )
);

# Use the Ticket ID to retrieve the Ticket Number.
$TicketNum = $client->__soapCall("Dispatch",
    array($username, $password,
        "TicketObject",   "TicketNumberLookup",
        "TicketID",       $TicketID,
    ));

# Make sure the ticket number is not displayed in scientific notation
$big_integer = 1202400000;
$Formatted_TicketNum = number_format($TicketNum, 0, '.', '');


# Print the info to the screen.
echo "<html>\n";
echo "<head>\n";
echo "<title>Ticket Successfully Submitted</title>\n";
echo "</head>\n";
echo "<body>\n";
echo "<h1>Success!</h1>\n";
echo "<p>You have successfully created ticket number $Formatted_TicketNum.</p>\n";
echo "</body>\n";
echo "</html>\n";




?>