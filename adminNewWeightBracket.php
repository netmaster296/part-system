<?php
include 'AdministratorController.php';

$controller = new AdministratorController();
if (isset($_POST['add2']))
{   
$controller->addNewWeightBracket($_POST['price'],$_POST['lowerbound'],$_POST['upperbound']);
echo '<h1 align="center">New Bracket Added</h1>';
}
$controller->displayWeightBrackets();

?>