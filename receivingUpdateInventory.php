<?php
include 'ReceivingController.php';

$controller = new ReceivingController();
echo "<body style='background-color: OliveDrab ; color: Gold;'>";
echo '<h1 align="center">Update Confirmation</h1>';

echo '<form method="post" action="receiving.php">';
echo '<input type="submit" name="submit" value="Return to Main Interface"/>';
echo '</form>';

//WHEN THE USER CLICKS UPDATE INVENTORY IT MUST RUN THROUGH THIS CHECK TO BE ABLE TO RUN UPDATE INVENTORY FUNCTION
if (isset($_POST["Item_no"])) 
{
    if ($_POST['Quantity'] != 0) 
    {
        $controller->updateQuantity($_POST["Item_no"],$_POST["Quantity"]);
    }
    else
    {
        echo "Error you entered zero for the quantity or did not specify a quantity.";
    }
    
    echo '<h2 align="center"> Updated Part Number '.$_POST["Item_no"].' by '.$_POST["Quantity"].' units</h2>';
}


echo '<form method="post" action="receiving.php">';
echo '<input type="submit" name="submit" value="Return to Main Interface"/>';
echo '</form>';

?>
