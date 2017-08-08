<?php
//create a session
session_start();
include 'OrderController.php';

//create new controller
$controller = new OrderController();


$controller->displayCreditCardCheckout();

?>