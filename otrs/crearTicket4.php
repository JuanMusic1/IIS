<?PHP
    error_reporting(E_ALL);
    $url      = "http://172.105.22.206/otrs/nph-genericinterface.pl/Webservice/k/";
    $username = "kevin";
    $password = "ZkIXwfabewFxouSR";
    $title    = "Soap listo!!!!";


    $client = new SoapClient(null, array('location'  => $url,
                                        'uri'       => "kevinEspacio",
                                        'trace'     => 1,
                                        'login'     => $username,
                                        'password'  => $password,
                                        'style'     => SOAP_RPC,
                                        'use'       => SOAP_ENCODED));

    $data= array(
        "Title"=>$title,
        "Queue"=>"ColaEIA",
        "Lock"=>"unlock",
        "PriorityID"=>2,
        "State"=>"new",
        "CustomerUser"=>"kevin",
        );
    $data2= array(
        "Subject"=>$title,
        "ContentType"=>"text/plain; charset=ISO-8859-1",
        "Body"=>"funciona",
        "AutoResponseType"=>'auto reply');

    $TicketID = $client->TicketCreate(
        new SoapParam($username, "CustomerUserLogin"),
        new SoapParam($password, "Password"),
        new SoapParam($data, "Ticket"),
        new SoapParam($data2, "Article")
    );

    var_dump($TicketID);

    echo "<html>\n";
    echo "<head>\n";
    echo "</head>\n";
    echo "<body>\n";

    echo "<p> Ticket id".$TicketID["TicketNumber"]." with article id ".$TicketID["TicketID"];
    echo "</body>\n";
    echo "</html>\n";

?>
