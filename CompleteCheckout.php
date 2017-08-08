<?php
include 'OrderController.php';

//create a session
session_start();

$controller = new OrderController();

$controller->displayPlaceOrder();

?>