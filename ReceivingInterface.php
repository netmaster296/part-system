<?php
/* Boundary Class for Receiving worker
 * @author Undergraduate Group One
 */
class ReceivingInterface
{
  public function displayMainInterface()
  {
    
    echo "<body style='background-color: RoyalBlue; color: Turquoise '>";
    echo '<h1 align="center">Receiving Desk Interface</h1>';
    
    echo '<table align="center">';
    echo '<tr><th>Method</th><th>Input</th><th>Search</th></tr>';
    echo '<form method="post" action="receivingEnterQuantity.php"';
      
      //search by part number table row
      echo '<tr>';
        echo '<td>Search by Part Number: </td>';
        echo '<td><input required type="number" name="receivingPartNumber"/></td>';
        echo '<td><input type="submit" name = "searchByPartNumber" value="search"/></td>';
      echo '</tr>';
      
    echo '</form>';
      
      //search by description table row
      echo '<form method="post" action="receivingEnterQuantity.php"';
      echo '<tr>';
        echo '<td>Search by Description: </td>';
        echo '<td><input required type="text" name="receivingDescription" /></td>';
        echo '<td><input type="submit" name = "searchByDescription" value="search"/></td>';
      echo '</tr>';
      
    echo '</form>';
    echo '</table>';
  }
  
  public function displayResults($rows)
  {      
      //TABLE HEADERS
      echo '<table align="center" border="1">';
      echo "<th> Part # </th>";
      echo "<th> Description </th>";
      echo "<th> Price </th>";
      echo "<th> Weight </th>";
      echo "<th> Image </th>";
      echo '<th width:80px>Qty Received</th>';
      echo "<th> Update Inventory</th>";
      
      
      //POPULATE TABLE
      foreach($rows as $row)
      {
          echo "<form method ='post' action='receivingUpdateInventory.php'>";
          $image = "<img src=" . $row[4] . " />";
          echo '<tr align = "center"> <td align = "center">' . $row[0] . "</td>" .
          "<td>" . $row[1] . "</td>" .
          "<td>" . $row[2] . "</td>" .
          "<td>" . $row[3] . "</td>" .
          "<td>" . $image . "</td>"; 
          echo '<td> <input required type="number" min="0" name="Quantity" value=""> </td>';
          echo '<td> <input required type="submit" name="updateInventory" value="Update Inventory" /> </td> </tr>';
          echo '<input required type="hidden" name="Item_no" value="'.$row[0].'">';
          echo "</form>";
      }//end of foreach
      echo "</table>";
  }
}

?>
