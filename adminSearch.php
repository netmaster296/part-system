<?php

include 'AdministratorController.php';

$controller = new AdministratorController();
echo "<body style='background-color: DarkKhaki'>";
echo '<h1 align="center">Search Results</h1>';
//if searching by Date

echo '<form method="post" action="AIIndex.php">';
echo '<input type="submit" name="submit" value="Return to Main Menu" />';
echo '</form>';

if(isset($_POST["lowerPrice"]) && isset($_POST["upperPrice"]))
{
  echo '<h2 align="center">Showing prices between $'.$_POST["lowerPrice"].'.00 and $'.$_POST["upperPrice"].'.00</h2>';
  
  $rows = $controller->searchByPrice($_POST["lowerPrice"],$_POST["upperPrice"]);
  $controller->displayOrders($rows);
}

else if(isset($_POST["orderStatus"]))
{
  echo '<h2 align="center">Showing status is '.$_POST["orderStatus"].'</h2>';
  
  $rows = $controller->searchByStatus($_POST["orderStatus"]);
  $controller->displayOrders($rows);
}

else if(isset($_POST["day"]) && isset($_POST["month"]) && isset($_POST["year"]))
{  
  //save variables
  $lowerDate = new DateTime($_POST["year"][0].'-'.$_POST["month"][0].'-'.$_POST["day"][0]);
  $lowerDateFinal = $lowerDate->format('Y-m-d H:i:s');
  
  $upperDate = new DateTime($_POST["year"][1].'-'.$_POST["month"][1].'-'.$_POST["day"][1]);
  $upperDateFinal = $upperDate->format('Y-m-d H:i:s');
  
  echo '<h2 align="center">Showing dates between '.$lowerDateFinal.' and '.$upperDateFinal.'</h2>';
  
  $rows = $controller->searchByDate($lowerDateFinal,$upperDateFinal);
  $controller->displayOrders($rows);
}
//return to interface
echo '<form method="post" action="AIIndex.php">';
echo '<input type="submit" name="submit" value="Return to Main Menu" />';
echo '</form>';
?>
