<?php

/**
 * @author Undergraduate Group One
 * Boundary class to Product Database
 */

class OurDatabase
{
  private $dsn, $username, $password, $pdo;

  //returns all rows in the Legacy Product Database
  public function accessDatabase($query)
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
}
?>