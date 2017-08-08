<?php
/*
 * @author Undergraduate Group One
 * Boundary Class for Administrator
 */
class AdministratorInterface
{
    var $dsn, $username, $password, $pdo;
     
    public function displayAdministratorInterface()
    {
     echo '<body style="background-color:#7F525D; color:White;">';
     echo '<form action="WeightBrackets.php">';   
     echo '<input type="submit" name="weightbrackets" value="Go To Weight Brackets" />';
     echo '</form>';
     
     
     echo '<h1> Administrator Interface </h1>';
          
            //if search by status is selected
      if(isset($_POST["statusSearch"]))
      {
         $this->displayStatusSearch();
      }
      //if search by date range is selected
      if(isset($_POST["dateSearch"]))
      {
        $this->displayDateSearch();
      }
      //if search by price range is selected
      if(isset($_POST["priceSearch"]))
      {
        $this->displayPriceSearch();
      }   
  
  		$dsn = "mysql:host=courses;dbname=z1808910";
          $username = "z1808910";
          $password = "1994Aug19";
  		$conn = new PDO($dsn,$username,$password);
  		try
  		{
  			$pdo = new PDO ($dsn, $username, $password);
  		}//end of try
  
  		catch(PDOexception $e)
  		{
  			echo $e->getMessage();
  		}//end of catch
  
  		$query = "SELECT * FROM Orders;";
  		$sql = $pdo->query($query);
  		$rows = $sql->fetchAll();
  
  		echo '<p align = "center">';
  		echo "<form method ='post' action=''>";
  
   		echo '<input type="submit" name="statusSearch" value="Search by Status" />';
      echo '<input type="submit" name="dateSearch" value="Search by Date Range" />';
      echo '<input type="submit" name="priceSearch" value="Search by Price Range" />';
  
  		echo '<table border="1">';
  		echo "<th> order # </th>";
  		echo "<th> status </th>";
  		echo "<th> Order Date </th>";
      echo "<th> Total Price </th>";
  		echo "<th> First Name </th>";
  		echo "<th> Last Name </th>";
  		echo "<th> Shipping Address </th>";
  		echo "<th> email Address </th>";
  
  
  		foreach($rows as $row)
  		{
        echo '<tr align = "center">';
  			echo '<td>' . $row[0] . "</td>";
  			echo     "<td>" . $row[1] . "</td>";
  			echo     "<td>" . $row[2] . "</td>";
  			echo     "<td>" . $row[3] . "</td>";
  			echo     "<td>" . $row[4] . "</td>";
  			echo     "<td>" . $row[5] . "</td>";
        echo     "<td>" . $row[6] . "</td>";
        echo     "<td>" . $row[7] . "</td>";
        echo "</tr>";
  		}
  
  		echo "</table>";
  		echo '<input type="submit" name="statusSearch" value="Search by Status" />';
  		echo '<input type="submit" name="dateSearch" value="Search by Date Range" />';
          echo '<input type="submit" name="priceSearch" value="Search by Price Range" />';	
          //check if submit button is clicked
          echo '<h3> Search based on Shipped Orders </h3>';
  		echo "</form>";
  		echo "</p>";
     
    }//end displayAdministratorInterface
    
    public function displayStatusSearch()
    {
      echo '<h1 align="center"> Search By Status</h1>';
       echo "<form method = 'POST' action = 'adminSearch.php'>";
       echo '<table align="center", border=2>';
       
       //TABLE HEADERS
       echo '<th>Desired Status</th>';
    
       //table items
       echo '<tr><td><select name="orderStatus">
             <option value="pending">pending</option>
             <option value="shipped">shipped</option>
             </td></tr>';
       //submit button
       echo '<tr><td><input required type="submit" name="submit" "align="center" value="search" /></td></tr></table></form>';
    }
    
    public function displayPriceSearch()
    {
       echo '<h1 align="center"> Search By Price</h1>';
       echo "<form method = 'POST' action = 'adminSearch.php'>";
       echo '<table align="center", border=2>';
       
       //TABLE HEADERS
       echo '<th>Lower Bound</th><th>Upper Bound</th>';
    
       //table items
       echo '<tr><td><input required type="number" name="lowerPrice"/></td>
             <td><input required type="number" name="upperPrice"/></td></tr>';
       //submit button
       echo '<tr><td><input required type="submit" name="submit" "align="center" value="search" /></td></tr></table></form>';
    }
    
    //displays a form to search Order database by Date
    public function displayDateSearch()
    {
       echo '<h1 align="center"> Search By Date</h1>';
       echo "<form method = 'POST' action = 'adminSearch.php'>";
       echo '<table align="center", border=2>';
       
       //TABLE HEADERS
       echo '<th>Bound</th><th>Month</th><th>Day</th><th>Year</th>';
       $firstRow = true;
       //MAKE TWO INSTANCES
       for($i = 0; $i<2; $i++)
       {
         if($firstRow)
         {
           echo "<tr><td>LowerBound</td>";
         }
         else
         {
           echo "<tr><td>UpperBound</td>";
         }
         //DROPDOWN FOR MONTH
         echo '<td>Month: <select name="month[]">';
         for($int=1; $int<13; $int++)
         {
           echo '<option value="'.$int.'">';
           echo $int;
           echo '</option>';
         }
         echo '</select>' . "</td><td> " ;
         
         //DROPDOWN FOR DAY
         echo 'Day: <select name="day[]">';
         for($int=1; $int<32; $int++)
         {
           echo '<option value="'.$int.'">';
           echo $int;
           echo '</option>';
         }
         echo '</select>';
         echo '</td><td>';
         
         //DROPDOWN FOR YEAR
         echo 'Year: <select name="year[]">';
         for($int=1999; $int<2060; $int++)
         {
           echo '<option value="'.$int.'">';
           echo $int;
           echo '</option>';
         }
         echo '</select>';
         echo '</td></tr>';
       } // end table generation loop
       echo '<tr><td><input required type="submit" name="submit" "align="center" value="search" /></td></tr>';
       
       echo "</table></form>";
       
    }
    
    //displays a table of all Orders searched
    public function displayOrders($rows)
    {
      echo '<table align="center" border=2>';
      echo '<th>Order Number</th><th>Order Status</th><th>Order Date</th><th>Total Price</th>
            <th>First Name</th><th>Last Name</th><th>Address</th><th>Email</th>';
      foreach($rows as $row)
      {
        echo '<tr align = "center">';
  			echo '<td>' . $row[0] . "</td>";
  			echo     "<td>" . $row[1] . "</td>";
  			echo     "<td>" . $row[2] . "</td>";
  			echo     "<td>" . $row[3] . "</td>";
  			echo     "<td>" . $row[4] . "</td>";
  			echo     "<td>" . $row[5] . "</td>";
        echo     "<td>" . $row[6] . "</td>";
        echo     "<td>" . $row[7] . "</td>";
        echo "</tr>";
      }
      echo '</table>';
    }
    
    public function displayWeightBrackets($rows)
    {
        echo '<body style="background-color: DarkOrange; color:White;">';
        echo '<h1 align="center"> Weight Brackets </h1>';
        
        if (isset($_POST['add']))
        {
         
          echo "<form method='post' action='adminNewWeightBracket.php'><table>";
          echo "<tr><td>New Price: <input required type ='text' name='price'/></td></tr>";
          echo "<tr><td>New LowerBound: <input required type ='text' name='lowerbound'/></td></tr>";
          echo "<tr><td>New UpperBound: <input required type ='text' name='upperbound'/></td></tr>";
          echo "<tr><td><input required name='add2' type='submit'/></td></tr>";
          echo "</table>";
                     
          echo "</form>";
   
          //cancel button
          echo "<form method='post' action='WeightBrackets.php'>";
          echo "<input type='submit' value='Cancel'/>";
          echo "</form>";     
        }
        
        
        if (!isset($_POST['add']))
        {    
          echo '<form method="post" action="">';
          echo '<input required type="submit" name="add" value="Add Weight Bracket" />';
          echo '</form>';
        }
        
        
        if (isset($_POST['edit']) && !isset($_POST['add']))
        {
          echo "<form method='post' action='adminEditWeightBracket.php'><table>";
          echo "<tr><td>New Price: <input required type ='text' name='price' value='".$_POST["price"]."'/></td></tr>";
          echo "<tr><td>New LowerBound: <input required type ='text' name='lowerbound' value='".$_POST["lowerbound"]."'/></td></tr>";
          echo "<tr><td>New UpperBound: <input required type ='text' name='upperbound' value='".$_POST["upperbound"]."'/> </td></tr>";
          echo "<tr><td><input required name='submit' type='submit'/></td></tr>";
          echo "<input type='hidden' name='id' value='".$_POST["id"]."' />";
          echo "</table>";
          echo "</form>";
   
          //cancel button
          echo "<form method='post' action='WeightBrackets.php'>";
          echo "<input type='submit' value='Cancel'/>";
          echo "</form>";
        } 
                            
        
        echo '<form action="AIIndex.php">';   
     echo '<input type="submit" name="weightbrackets" value="Return to All Orders" />';
     echo '</form>';
     
      //TABLE HEADERS
      echo '<table align="center" border="1">';
      echo "<th> Price </th>";
      echo "<th> Lower Bound </th>";
      echo "<th> Upper Bound </th>";
      echo "<th> Edit Weight Bracket </th>";
      echo "<th> Delete Weight Bracket </th>";
        
        
      //POPULATE TABLE
      foreach($rows as $row)
      {
          echo '<tr align = "center"> <td align = "center">' . $row[0] . "</td>" .
          "<td>" . $row[1] . "</td>" .
          "<td>" . $row[2] . "</td>";
          //we hold hidden variables because we need to populate fields with edit
          echo '<td>
                  <form method="post" action="">
                  <input type="submit" name="edit" value="Edit"/>
                  <input type="hidden" name="id" value="'.$row[3].'"/>
                  <input type="hidden" name="price" value="'.$row[0].'" />
                  <input type="hidden" name="lowerbound" value="'.$row[1].'" />
                  <input type="hidden" name="upperbound" value="'.$row[2].'" />
                  </form>
                </td>';
          echo '<td>
                  <form method="post" action="adminDeleteWeightBracket.php">
                  <input type="submit" name="delete" value="Delete"/>
                  <input type="hidden" name="id" value="'.$row[3].'"/>
                  </form>
                </td>
                </tr>';
          echo '';
      }//end of foreach
      
      echo "</table>";
     
      echo '<form action="AIIndex.php">';   
      echo '<input type="submit" name="weightbrackets" value="Return To All Orders" />';
      echo '</form>';
    }
}

?>
