<?php
/*Boundary class for shipping workers
 *@author: Undergraduate group one
 */
 
 class ShippingInterface
 {
   public function displayPendingOrders($rows)
   {
     
       echo "<body style='background-color: IndianRed; color:LightYellow;'>";
      echo '<h1 align="center">Pending Orders</h1>';
      echo '<table align="center" border=2>';
      echo '<th>Order Number</th><th>Order Status</th><th>Order Date</th><th>Total Price</th>
            <th>First Name</th><th>Last Name</th><th>Address</th><th>Email</th><th>Select</th>';
      
      
      foreach($rows as $row)
      {
        echo '<form method="post" action="completeorder.php">';
        echo '<tr align = "center">';
  			echo '<td>' . $row[0] . "</td>";
  			echo     "<td>" . $row[1] . "</td>";
  			echo     "<td>" . $row[2] . "</td>";
  			echo     "<td>" . $row[3] . "</td>";
  			echo     "<td>" . $row[4] . "</td>";
  			echo     "<td>" . $row[5] . "</td>";
        echo     "<td>" . $row[6] . "</td>";
        echo     "<td>" . $row[7] . "</td>";
        echo     '<td><input type="submit" name="ship[]" value="print order information" /></td>';
        echo '<input type="hidden" name="orderNumber" value="'.$row[0].'"/>';
        echo "</tr>";
        echo '</form>';
      }
      
      
      echo '</table>';
    }
    
    public function displayOrderDetails($rows)
    {
        echo "<body style='background-color: IndianRed; color:LightYellow;'>";
      echo '<h1 align="center">Order details</h1>';
      echo '<table align="center" border=2>';
      /*
      p.partNum,p.quantity,o.orderStatus,o.firstName,o.lastName,o.address,o.email
      */
      echo '<th>Part Number</th><th>Description</th><th>Quantity</th><th>Status</th><th>Total Price</th><th>First name</th>
            <th>Last Name</th><th>Address</th><th>Email</th>';
      $count = 0;
      foreach($rows as $row)
      {
        echo '<tr>';
          echo '<td>'.$row[0].'</td>';
          echo '<td>'.$_SESSION["partDescriptions"][$count][0].'</td>';
          echo '<td>'.$row[1].'</td>';
          echo '<td>'.$row[2].'</td>';
          echo '<td>'.$row[3].'</td>';
          echo '<td>'.$row[4].'</td>';
          echo '<td>'.$row[5].'</td>';
          echo '<td>'.$row[6].'</td>';
          echo '<td>'.$row[7].'</td>';
        echo '</tr>';
        $count++;
      }     
      
      echo '</table>';
    }
 }
 
?>
