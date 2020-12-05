<?php
    require_once '../../utils/connect_database.php';

    // Check connection
    if(!$conn) 
    {  
        die("Connection failed");
    }
    else 
    {
        // Change to Order values

        $Order_Id = filter_input(INPUT_POST, 'ORDER_ID');
        $Pts = filter_input(INPUT_POST, 'Pts');
        $Trans_Date = filter_input(INPUT_POST, 'Trans_Date');
        $Cust_Id = filter_input(INPUT_POST, 'Cust_Id');
        $Item_Id = filter_input(INPUT_POST, 'Item_Id');
        $Est_Id = filter_input(INPUT_POST, 'Est_Id');

        if($query = "INSERT INTO ORDERS (ORDER_ID, Pts, Trans_Date, Cust_Id, Item_Id, Est_Id) VALUES (:ORDER_ID, :Pts, :Trans_Date, :Cust_Id, :Item_Id, :Est_Id)")
        {    
            if($query==null)
            {      
                echo "Unable to insert due to violation.";      
                die();    
            }    
            else
            {
                $stmt = $conn->prepare($query);  
                $stmt->execute(array(':ORDER_ID' => $ORDER_ID, ':Pts' => $Pts, ':Trans_Date' => $Trans_Date, ':Cust_Id' => $Cust_Id, ':Item_Id' => $Item_Id, ':Est_Id' => $Est_Id));
                $rows = $stmt->fetchALL(PDO::FETCH_ASSOC);
                if($stmt)
                    echo 'New record inserted successfully.';
                else
                {
                    echo "Unable to insert due to violation. Please check your input and the table."; 
                }
            }
        }

    }
    echo '<p><a href="javascript:history.go(-1)" title="return">&laquo; Return to Slash-Trash HomepItem_Id</a></p>';    
?>