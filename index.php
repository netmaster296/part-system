<?php

include 'OrderController.php';

//create a session
session_start();
//create new controller
$controller = new OrderController();

//display catalog
$query = "SELECT * FROM parts;";
$controller->displayCatalog($controller->accessCatalog($query));

?>