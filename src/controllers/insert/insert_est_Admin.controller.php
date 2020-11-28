<?php
    $host = "localhost:3306";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "SLASHTRASH";

// Create connection
$conn = new PDO('mysql:host='.$host.';dbname='.$dbname, $dbusername, $dbpassword);

// Check connection
if(!$conn)
{
    die("Connection failed");
}
else
{
    $Admin_Id = filter_input(INPUT_POST, 'Admin_Id');
    $EAName = filter_input(INPUT_POST, 'EAName');
    $Phone = filter_input(INPUT_POST, 'Phone');
    $EAEmail = filter_input(INPUT_POST, 'EAEmail');
    $Est_Id = filter_input(INPUT_POST, 'Est_Id');

    if($query = "INSERT INTO establishment_admin (Admin_Id, EAName, Phone, EAEmail, Est_Id) VALUES (:Admin_Id, :EAName, :Phone, :EAEmail, :Est_Id)")
    {
        if($query==null)
        {
            echo "Unable to insert due to violation.";
            die();
        }
        else
        {
            $stmt = $conn->prepare($query);
            $stmt->execute(array(':Admin_Id' => $Admin_Id, ':EAName' => $EAName, ':Phone' => $Phone, ':EAEmail' => $EAEmail, ':Est_Id' => $Est_Id));
            $rows = $stmt->fetchALL(PDO::FETCH_ASSOC);
            echo 'New record inserted successfully.';
        }
    }
}
?>
