<?php
include 'OrderController.php';
/*
 * @author Undergraduate Group One
 * Boundary Class for Customers
 */

//create new controller
$controller = new OrderController();

//display current cart
$controller->displayCart($controller->accessCart());
?>