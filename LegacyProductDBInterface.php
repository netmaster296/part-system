<?php

/**
 * @author Undergraduate Group One
 * Boundary class to Product Database
 */
class LegacyProductDBInterface
{
    private $dsn, $username, $password, $pdo;

    //returns all rows in the Legacy Product Database
    public function accessDatabase($query)
    {
        $dsn = "mysql:host=blitz.cs.niu.edu;dbname=csci467";
        $username = "student";
        $password = "student";
    
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
  

    //searches the database for cart items for Customers.
    //Takes an array of partnumbers for reference
    //returns the full database listing of those parts.
    public function customerSearchDatabase($partNumArray)
    {
    
        $dsn = "mysql:host=blitz.cs.niu.edu;dbname=csci467";
        $username = "student";
        $password = "student";
    
        try
        {
            $pdo = new PDO($dsn, $username, $password);
        }//end of try
  
        catch(PDOexception $e) {
        echo $e->getMessage();
        }//end of catch
        
        
        $firstItem = true;
        $query = "SELECT * FROM parts WHERE";

        foreach($partNumArray as $part_no)
        {
            if($firstItem==true)
            {
                $query = $query . " number=" . $part_no;
                $firstItem = false;
            }
            else
            {
                $query = $query . " OR number=" . $part_no;
            }
        }
    
        $query = $query.";";
    
        try
        {
            $pdo = new PDO($dsn, $username, $password);
        }//end of try

        catch(PDOexception $e) 
        {
            echo $e->getMessage();
        }//end of catch
    
        $sql = $pdo->query($query);
        $rows = $sql->fetchAll();
    
        return $rows;
    }
    
    public function shippingSearchDatabase($partNumArray)
    {
    
        $dsn = "mysql:host=blitz.cs.niu.edu;dbname=csci467";
        $username = "student";
        $password = "student";
    
        try
        {
            $pdo = new PDO($dsn, $username, $password);
        }//end of try
  
        catch(PDOexception $e) {
        echo $e->getMessage();
        }//end of catch
        
        
        $firstItem = true;
        $query = "SELECT description FROM parts WHERE";

        foreach($partNumArray as $part_no)
        {
            if($firstItem==true)
            {
                $query = $query . " number=" . $part_no;
                $firstItem = false;
            }
            else
            {
                $query = $query . " OR number=" . $part_no;
            }
        }
    
        $query = $query.";";
    
        try
        {
            $pdo = new PDO($dsn, $username, $password);
        }//end of try

        catch(PDOexception $e) 
        {
            echo $e->getMessage();
        }//end of catch
        $sql = $pdo->query($query);
        $rows = $sql->fetchAll();
    
        return $rows;
    }
   
    //returns the items in Cart
    public function accessCart()
    {
        //retrieves imformation from Legacy DB to display selected part_no
        //information from our product system database
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
        
        $query = "SELECT part_no FROM Part;";
        $sql = $pdo->query($query); 
        $rows = $sql->fetchAll();
    
    
        //add OR to the beginning of every part number retrieved
        if ($rows != NULL)//if the query returned an array run this
        {
            $query="SELECT * FROM parts WHERE number = ";
            //add an AND between part numbers
            foreach ($rows as $row)
            {
                $query .= $row[0];
                $query .= " OR number = ";
            }
        
            //Delete the trailing OR statement
            $query=substr($query, 0, -13);
            $query .= ";";
            
            //access the data in rows and return it
            $dsn = "mysql:host=blitz.cs.niu.edu;dbname=csci467";
            $username = "student";
            $password = "student";
        
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
        }
    

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
  
      $pdo->query($query); 
    } 
}

?>