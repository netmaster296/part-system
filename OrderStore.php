<?php

//create a session
session_start();
class OrderStore 
{
    public function accessOrderStoreDatabase($query)
    {
        $dsn = "mysql:host=courses;dbname=z1808910";
        $username = "z1808910";
        $password = "1994Aug19";
    
        try
        {
            $pdo = new PDO($dsn, $username, $password);
        }//end of try
  
        catch(PDOexception $e) {
            echo $e->getMessage();
        }//end of catch
    
        $sql = $pdo->query($query); 
        $rows = $sql->fetchAll();
    
        return $rows;
    }//end of accessDatabase


  function newOrder($total,$fname,$lname,$address,$email)
  {

   //echo $shippingaddress;
   $lastordernum=OrderStore::getLastOrderNumber();
   
   $lastordernum += 1;
   
   //get part numbers and quantities from cart...
    $dsn = "mysql:host=courses;dbname=z1808910";
    $username = "z1808910";
    $password = "1994Aug19";
    $query="SELECT * FROM Part;";  
    try
    {
        $pdo = new PDO($dsn, $username, $password);
    }//end of try
  
    catch(PDOexception $e) {
        echo $e->getMessage();
    }//end of catch
  
    $sql = $pdo->query($query);
    $rows = $sql->fetchAll();
    
    $partNums = array();
    $quantities = array();
    
    //add partnums and quantities to OrderedParts...
    foreach($rows as $row)
    {
      $query="INSERT INTO OrderedParts(orderNum,partNum,quantity)";
      $query.=" VALUES(".$lastordernum.", ".$row[0].", ".$row[1].");";
      $sql = $pdo->query($query);
    }
   //add to Orders database
   $query = "INSERT INTO Orders (orderStatus,orderDate,totalprice,firstname,lastname,email,address) VALUES (";
   $query .= "'pending','";
   
   //DATE DETERMINATION; Our timezone is America/Chicago
   date_default_timezone_get();
   $date = date('Y/m/d h:i:s', time());
   //END DATE CALCULATION
   
   $query .= $date;
   $query .= "','";
   $query .= $total;
   $query .= "','";
   $query .= $fname;
   $query .= "','";
   $query .= $lname;
   $query .= "','";
   $query .= $email;
   $query .= "','";
   $query .= $address;
   $query .= "');";
   
    $dsn = "mysql:host=courses;dbname=z1808910";
    $username = "z1808910";
    $password = "1994Aug19";
  
    try
    {
        $pdo = new PDO($dsn, $username, $password);
    }//end of try
  
    catch(PDOexception $e) {
        echo $e->getMessage();
    }//end of catch
  
    $sql = $pdo->query($query); 
   
  }//end of neworder
  
  function setShipping($shippingAddress,$email)
  {
       //echo $shippingaddress;
       $lastordernum=OrderStore::getLastOrderNumber();
       $query = "UPDATE Orders SET address = '";
       $query .= $shippingAddress;
       $query .= "', email = '";
       $query .= $email;
       $query .= "' WHERE orderNumber =";
       $query .= $lastordernum;
       $query .= ";";
       
       //echo $query;
       $controller = new OrderController();
       $rows=$controller->accessOrderStore($query);
   
  }//end of setShipping
  
  function searchOrdersDate()
  {
    
  }//end of searchorders
  
  /* This function gets all Orders from the database and is meant for use in the Administrator interface.
   * It returns the rows of the database
   */
  function viewOrders()
  {
    return OrderStore::accessOrderStore("SELECT * FROM Orders");
  }//end of vieworders
  
  public static function getLastOrderNumber()
  {
      $dsn = "mysql:host=courses;dbname=z1808910";
      $username = "z1808910";
      $password = "1994Aug19";
  
      try
      {
          $pdo = new PDO($dsn, $username, $password);
      }//end of try

      catch(PDOexception $e) {
      echo $e->getMessage();
      }//end of catch
  
      $sql = $pdo->query("SELECT orderNumber FROM Orders"); 
      $rows = $sql->fetchAll();
      if ($rows != null)
      {
        foreach ($rows as $row)
          {
          $lastordernum=$row;
          }
        return $lastordernum[0];
      }
      else
      {
        return "1";
      }
  }
      
    public function searchByDate($lower, $upper)
    {
      $dsn = "mysql:host=courses;dbname=z1808910";
      $username = "z1808910";
      $password = "1994Aug19";
  
      try
      {
          $pdo = new PDO($dsn, $username, $password);
      }//end of try

      catch(PDOexception $e) {
      echo $e->getMessage();
      }//end of catch
      
      $query = "SELECT * FROM Orders WHERE orderDate > '".$lower."' AND orderDate < '".$upper."';";
      $sql = $pdo->query($query); 
      $rows = $sql->fetchAll();
      return $rows;
    }
    
    public function searchByPrice($lower,$upper)
    {
      $dsn = "mysql:host=courses;dbname=z1808910";
      $username = "z1808910";
      $password = "1994Aug19";
  
      try
      {
          $pdo = new PDO($dsn, $username, $password);
      }//end of try

      catch(PDOexception $e) {
      echo $e->getMessage();
      }//end of catch
      
      $query = "SELECT * FROM Orders WHERE totalprice > ".$lower." AND totalPrice < ".$upper.";";
      $sql = $pdo->query($query); 
      $rows = $sql->fetchAll();
      return $rows;
    }
    
    public function searchByStatus($status)
    {
      $dsn = "mysql:host=courses;dbname=z1808910";
      $username = "z1808910";
      $password = "1994Aug19";
  
      try
      {
          $pdo = new PDO($dsn, $username, $password);
      }//end of try

      catch(PDOexception $e) {
      echo $e->getMessage();
      }//end of catch
      
      $query = "SELECT * FROM Orders WHERE orderStatus =  '".$status."';";
      $sql = $pdo->query($query); 
      $rows = $sql->fetchAll();
      return $rows;
    }
    
    //returns parts and quantities for an order....
    public function getOrderDetails($orderNum)
    {
      $dsn = "mysql:host=courses;dbname=z1808910";
      $username = "z1808910";
      $password = "1994Aug19";
  
      try
      {
          $pdo = new PDO($dsn, $username, $password);
      }//end of try

      catch(PDOexception $e) {
      echo $e->getMessage();
      }//end of catch
      $query=" SELECT p.partNum,p.quantity,o.orderStatus,o.totalPrice,o.firstName,o.lastName,o.address,o.email 
               FROM Orders o, OrderedParts p 
               WHERE p.orderNum = o.orderNumber AND p.orderNum = ".$orderNum.";";
      
      $sql = $pdo->query($query); 
      $rows = $sql->fetchAll();  
      
      return $rows;    

    }
    
    public function getPendingOrders()
    {
      return searchByStatus("pending");
    }
    
    public function saveOrderDetails($rows)
    {
      //declare session variables
      $_SESSION["shippingPartNum"]     = array();
      $_SESSION["shippingQuantity"]    = array();
      $_SESSION["shippingOrderStatus"] = array();
      $_SESSION["shippingFirstName"]   = array();
      $_SESSION["shippingLastName"]    = array();
      $_SESSION["shippingAddress"]     = array();
      $_SESSION["shippingEmail"]       = array();
      
      //loop through rows
      foreach($rows as $row)
      {
        array_push($_SESSION["shippingPartNum"],$row[0]);
        array_push($_SESSION["shippingQuantity"],$row[1]);
        array_push($_SESSION["shippingOrderStatus"],$row[2]);
        array_push($_SESSION["shippingFirstName"],$row[3]);
        array_push($_SESSION["shippingLastName"],$row[4]);
        array_push($_SESSION["shippingAddress"],$row[5]);
        array_push($_SESSION["shippingEmail"],$row[6]);
      }
    }
    
    public function setShipped($orderNum)
    {
      $dsn = "mysql:host=courses;dbname=z1808910";
      $username = "z1808910";
      $password = "1994Aug19";
  
      try
      {
          $pdo = new PDO($dsn, $username, $password);
      }//end of try

      catch(PDOexception $e) {
      echo $e->getMessage();
      }//end of catch
      $query=" UPDATE  Orders SET orderStatus = 'shipped' WHERE orderNumber = ".$orderNum.";";
      
      $sql = $pdo->query($query);
  }
      
}//end of orderstore class

class Order
{
    var $shippingAddress;
    var $date;
    var $firstName;
    var $lastName;
    var $status;
    var $orderNo;
}
?>