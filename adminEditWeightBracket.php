<?php
include 'AdministratorController.php';

$controller = new AdministratorController();   
$controller->editWeightBracket($_POST['price'],$_POST['lowerbound'],$_POST['upperbound'],$_POST['id']);

echo '<h1 align="center">Bracket Edited</h1>';

$controller->displayWeightBrackets();

?>