<?php
include 'AdministratorController.php';

$controller = new AdministratorController();   
$controller->deleteWeightBracket($_POST['id']);

echo '<h1 align="center">Bracket Successfully Deleted</h1>';

$controller->displayWeightBrackets();

?>