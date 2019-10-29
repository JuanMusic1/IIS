<?PHP
    error_reporting(E_ALL);
    $url      = "http://172.105.22.206/otrs/nph-genericinterface.pl/Webservice/sofia/";
    $username = "sofia";
    $password = "ZkIXwfabewFxouSR";
    
    //Parametros para la creacion del ticket
    $usern = $_POST['username_id'];
    $issue_type = $_POST['issue_type'];
    $subject = $_POST['subject'];
    $title = $usern.'-Problema con '.' '.$issue_type.' - '.$subject;
    $description = $_POST['description'];
    $category = $_POST['category'];

    // Conexion con el servvicio SOAP
    $client = new SoapClient(null, array('location'  => $url,
                                        'uri'       => "sofiaT",
                                        'trace'     => 1,
                                        'login'     => $username,
                                        'password'  => $password,
                                        'style'     => SOAP_RPC,
                                        'use'       => SOAP_ENCODED));

    // Data ticket
    $data = array(
        "Title" => $title,
        "Queue" => "ColaEIA",
        "Lock" => "unlock",
        "PriorityID" => 2,
        "State" => "new",
        "CustomerUser" => "sofia",
        );
        
    // Data Articulo
    $data2 = array(
        "Subject" => $title,
        "ContentType" => "text/plain; charset=ISO-8859-1",
        "Body" => $description,
        "AutoResponseType" => 'auto reply');    
        
    // Crea tickete
    $TicketID = $client->TicketCreate(
        new SoapParam($username, "CustomerUserLogin"),
        new SoapParam($password, "Password"),
        new SoapParam($data, "Ticket"),
        new SoapParam($data2, "Article")
    );

    $big_integer = 1202400000;
    $Formatted_TicketNum = number_format($TicketID["TicketNumber"], 0, '.', '');

    # Print the info to the screen.
    echo "<p> Id del tickete: ".$Formatted_TicketNum." con articulo: ".$TicketID["TicketID"];

?>