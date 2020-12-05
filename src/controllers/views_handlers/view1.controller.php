<?php
    require_once '../../utils/connect_database.php';

    // Check connection
    if(!$conn) 
    {  
        die("Connection failed");
    }
    else 
    {
        $cust_id = filter_input(INPUT_POST, 'Cust_Id');
        $start = filter_input(INPUT_POST, 'from_date');
        $end = filter_input(INPUT_POST, 'to_date');
        
        /*$custom_view = "CREATE OR REPLACE VIEW TRANSACTION_INFO(Cust_Id, CName, Cust_Pts, Est_Id, EName, Order_Id, Pts, Trans_Date, Item_Id, IName)
        AS SELECT   C.Cust_Id, C.CName, C.Cust_Pts, E.Est_Id, E.EName, O.Order_Id, O.Pts, O.Trans_Date, I.Item_Id, I.IName
        FROM CUSTOMER AS C, ESTABLISHMENT AS E, ORDERS AS O, REUSABLE_ITEM AS I
        WHERE C.Cust_Id = O.Cust_Id AND I.Item_Id = O.Item_Id AND E.Est_Id = O.Est_Id;";
        echo "<br>".$custom_view;
        if ($conn->query($custom_view) == TRUE) {
            echo "<br> TRANSACTION_INFO VIEW is successfully updated.";
        } else {
            echo "Error: " . $custom_view . "<br>" . $conn->error;
        }
        */
        $query = "SELECT DISTINCT Cust_Id, CName, SUM(Pts)
                FROM TRANSACTION_INFO
                WHERE Cust_Id = \"".$cust_id."\" AND Trans_Date >= \"".$start."\" AND Trans_Date <= \"".$end."\"
                GROUP BY Cust_Id;";
        $result = $conn->query($query);
        if ($result)
        {
            $data = $result->fetch(PDO::FETCH_NUM);
            if($data)
            {
                echo "<Br /><b>";
                echo "Customer, ".$data[1]."(".$data[0].") have gained ".$data[2].
                " points between ".$start." and ".$end;
                echo "</b>";
            }
            else
            {
                echo "<Br /><b>";
                echo "Customer with ID ".$cust_id." made no transaction between ".$start." and ".$end;
                echo "</b>";
            }
        }
        else
        {
            echo "Error:".$query."
            ".$conn->error;
        }
    }
    echo '<p><a href="javascript:history.go(-1)" title="return">&laquo; Return to Slash-Trash HomepType</a></p>';
?>
