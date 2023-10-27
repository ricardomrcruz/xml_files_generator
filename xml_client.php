<?php
header('Content-Type: text/xml');

$limit = isset($_GET["limit"]) ? intval($_GET["limit"]) : null;
$limit = isset($_GET["limit"]) ? intval($_GET["date"]) : null;


include 'inc/dbconnection.php'; //connection bdd
include 'model/dateInterval.php'; //calculatrice dateInterval
include 'model/customerData.php'; // include model class fetch customers

$xml = new DomDocument('1.0'); // Creation noveau XML document
$xml->formatOutput = true; // Define Format pour lisibilité

$clients = $xml->createElement("clients");
$xml->appendChild($clients);

$customerData = new CustomerData($pdo);
$rows = $customerData->display_dataCustomer($limit);

//boucle loop display ps custumers = data générale clients

foreach ($rows as $row) {
    $client = $xml->createElement("client");
    $clients->appendChild($client);

    $id = $row['id_customer'];
    $id_element = $xml->createElement("id", $id);
    $client->appendChild($id_element);

    $firstname = $row['firstname'];
    $firstname_element = $xml->createElement("first_name", $firstname);
    $client->appendChild($firstname_element);
    
    $lastname = $row['lastname'];
    $lastname_element = $xml->createElement("last_name", $lastname);
    $client->appendChild($lastname_element);


    $gender = $row['id_gender'];
    if ($gender == 1){
          $gender = "homme";
    }elseif($gender == 2){
         $gender = "femme";
     }
    $gender_element = $xml->createELement("gender", $gender);
    $client->appendChild($gender_element); 
    

    $birthday = $row['birthday'];
    
    $dateTime = $birthday;
    $age = calculateDateInterval($dateTime);   // utilisation inc function pour retourne birthday en age
    $age_element = $xml->createElement("age", $age);
    $client->appendChild($age_element);

    $birthday_element = $xml->createElement("birthday", $birthday);
    $client->appendChild($birthday_element);


    $email = $row['email'];
    $email_element = $xml->createElement("email", $email);
    $client->appendChild($email_element);
    

    $registration_date = $row['date_add'];
    $date = date('d-m-Y', strtotime($registration_date)); // Extraction date in d-m-Y
    $registration_date_element = $xml->createElement("registration_date", $date);
    $client->appendChild($registration_date_element);

    $date_upd = $row['date_upd'];
    $date_upd_element = $xml->createElement("date_upd", $date_upd);
    $client->appendChild($date_upd_element);

    // function call

    $lines = $customerData->display_dataCustomerAddress($id);

    //boucle loop display ps_address = data info contacte clients

    foreach ($lines as $line) {
        $address1 = $line['address1'];
        $address1_element = $xml->createElement('address1', $address1);
        $client->appendChild($address1_element);
        
        $address2 = $line['address2'];
        $address2_element = $xml->createElement('address2', $address2);
        $client->appendChild($address2_element);
        
        $postcode = $line['postcode'];
        $postcode_element = $xml->createElement('postcode', $postcode);
        $client->appendChild($postcode_element);

        $city = $line['city'];
        $city_element = $xml->createElement('city', $city);
        $client->appendChild($city_element);

        $email = $line['email'];
        $email_element = $xml->createElement('email', $email);
        $client->appendChild($email_element);
        
        $phone = $line['phone'];
        $phone_element = $xml->createElement('phone', $phone);
        $client->appendChild($phone_element);
        
        $phone_mobile = $line['phone_mobile'];
        $phone_mobile_element = $xml->createElement('phone_mobile', $phone_mobile);
        $client->appendChild($phone_mobile_element);
        
        $company = $line['company'];
        $company_element = $xml->createElement('company', $company);
        $client->appendChild($company_element);
        
    }
    
}

echo $xml->saveXML();



//EXAMPLE CREATION RELATION PERE ENFANT XML TEMPLATE
// CHILD PARENT RELATION 

// $clients = $xml->createElement("clients");
// $xml->appendChild($clients);

// $client = $xml->createElement("client");
// $clients->appendChild($client);


