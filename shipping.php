<?php

//webpage for Shipping use case
include 'ShippingController.php';

$controller = new ShippingController();
if(isset($_POST["setShipped"]))
{
  //display email confirmation if the order has been completed
  echo '<h3 align="center">A shipping confirmation email has been sent!</h3>';
  //update status of the order
  $controller->setShipped($_POST["orderNumber"]);
}
//display all pending orders
$controller->displayPendingOrders($controller->getPendingOrders());

?>