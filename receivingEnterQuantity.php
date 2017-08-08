<?php
include 'ReceivingController.php';
$controller = new ReceivingController();

    echo '<body style="background-color:PaleVioletRed ;">';

echo '<h1 align="center">Search Results</h1>';

echo '<form method="post" action="receiving.php">';
echo '<input type="submit" name="submit" value="Return to Main Interface"/>';
echo '</form>';

//create query based on type of search
if(isset($_POST["searchByDescription"]))
{
  $query = "SELECT * FROM parts WHERE description LIKE '%".$_POST["receivingDescription"]."%';";
  $controller->displayResults($controller->accessDatabase($query));
}

else if(isset($_POST["searchByPartNumber"]))
{
  $query = "SELECT * FROM parts WHERE number=".$_POST["receivingPartNumber"].";";
  $controller->displayResults($controller->accessDatabase($query));
}

echo '<form method="post" action="receiving.php">';
echo '<input type="submit" name="submit" value="Return to Main Interface"/>';
echo '</form>';


?>
