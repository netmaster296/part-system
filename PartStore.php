<?php
/* Part store persistence class
 * @author Undergraduate Group One
 */
class PartStore
{
    private $dsn, $username, $password, $pdo;


    //returns all rows in the Legacy Product Database
    public function accessPartStoreDatabase($query)
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
    
    
        //$query = "SELECT * FROM parts;";
        $sql = $pdo->query($query); 
        $rows = $sql->fetchAll();
    
        return $rows;
    }//end of accessDatabase
    
  
    //returns all rows in the Legacy Product Database
    public function removeFromDatabase($query)
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
    
    
        //$query = "SELECT * FROM parts;";
        $sql = $pdo->query($query); 
    }//end of removeFromDatabase
  
    //Takes a part number and returns quantity from cart
    public function get_quantity($part_no)
    {
        $query = "SELECT quantity FROM Part WHERE part_no =";
        $query .= $part_no;
    
    
        $rows=PartStore::accessPartStoreDatabase($query);
        return $rows[0][0];
    }
    public function addToCart($query)
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
    }
    public function emptyCart()
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
  
      $query = "DELETE FROM Part";
      $sql = $pdo->query($query);
    }
   
    public function updateInventory($rows)
    {
    
     
     //echo $row[0];//itemno
     //echo $row[1];//qty
     
     
     
     
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
     
     foreach ($rows as $row)
     {  
       //get the current quantity
      $query1 = "SELECT quantity FROM PartInventory WHERE partNumber =";
      $query1 .= "$row[0]";
      $query1 .= ";";
      $sql = $pdo->query($query1);
      $currentQty = $sql->fetchAll();
  
      $updateQty = $currentQty[0][0] - $row[1];
      
      //echo $currentQty[0][0];
      //echo $row[1];
      //echo $updateQty;
  
  
      $query = "UPDATE PartInventory SET quantity =";
      $query .= $updateQty;
      $query .= " WHERE partNumber =";
      $query .= $row[0];
      $query .= ";"; 
      
      //echo $query;
      $sql = $pdo->query($query);
    
      }
     }
    
    public function getQuantity($partnum)
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
  
      $query = "SELECT quantity FROM PartInventory WHERE partNumber =";
      $query .= "$partnum";
      $sql = $pdo->query($query);
      $rows = $sql->fetchAll();
    
      return $rows[0][0];
       
    }
    
    public function receivingUpdateInventory($partNum, $quantity)
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
  
      $query = "UPDATE PartInventory SET quantity = quantity + ".$quantity." WHERE partNumber = ".$partNum.";";
      $sql = $pdo->query($query);
    }
}

class Part
{
    var $partNumber;
    var $quantity;
   
   public function __construct($row)
   {
       $partNumber = $row[0];
       $quantity   = $row[1];
   }
}