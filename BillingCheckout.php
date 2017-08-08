<?php

include 'OrderController.php';
//create a session
session_start();

//create new controller
$controller = new OrderController();


$controller->displayBillingCheckout();

?>