<?php
include 'ShippingController.php';

$controller = new ShippingController();

$rows = $controller->getOrderDetails($_POST["orderNumber"]);
$partNumArray = array();

//get array of partNums
foreach($rows as $row)
{
  array_push($partNumArray,$row[0]);
}

//set a session variable of $rows
$_SESSION["partDescriptions"] = $controller->shippingSearchDatabase($partNumArray);

$controller->displayOrderDetails($rows);

//"PRINT" (because we don't actually print it) a shipping label, packing list, and invoice with the data provided and return to main page.
echo '<h3 align="center"> A packing list, invoice and shipping label have been printed.</h3>';
echo '<form method="post" action="shipping.php">';
echo '<table align="center"><th></th><tr><td><input type="submit" name="setShipped" value="Set as shipped" /></td></tr></table>';
echo '<input type="hidden" name="orderNumber" value="'.$_POST["orderNumber"].'"/>';

echo '</form>';

?>