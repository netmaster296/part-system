<?php 

class WeightStore
{
        //returns all rows in the Legacy Product Database
    public function calculateShipping($totalweight)
    {
      if ($totalweight < 5)
      {
       return 5;
      }
      else if ($totalweight < 10 && $totalweight > 5)
      {
       return 10;
      }
      else if ($totalweight < 20 && $totalweight > 10)
      {
       return 25;
      }
      else if ($totalweight < 50 && $totalweight > 20)
      {
       return 50;
      }
      else 
      {
       return 100;
      }
    }//end of calculateShipping
    
    public function accessWeightBrackets($query)
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
    }//end of getWeightBrackets
    public function newWeightBracket($price,$lowerbound,$upperbound)
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
         
         $query = "INSERT INTO WeightBrackets(price,lowerbound,upperbound) VALUES(";
         $query .= $price;
         $query .= ",";
         $query .= $lowerbound;
         $query .= ",";
         $query .= $upperbound;
         $query .= ");";
            
         $sql = $pdo->query($query); 
  
    }
    
    public function deleteWeightBracket($id)
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
         
         $query = "DELETE FROM WeightBrackets WHERE id=".$id.";";
            
         $sql = $pdo->query($query);
    }
    
    public function editWeightBracket($price,$lowerbound,$upperbound,$id)
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
         
         $query = "UPDATE WeightBrackets SET ";
         $query .= "price = ".$price;
         $query .= ",lowerbound = ".$lowerbound;
         $query .= ",upperbound = ".$upperbound;
         $query .= " WHERE id = ".$id.";";
            
         $sql = $pdo->query($query); 
    }
    
    //returns upperbound from sql database based on $id.
    public function getUpperBound($id)
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
         
         $query = "SELECT upperbound FROM WeightBrackets WHERE id = ".$id.";";
            
         $sql = $pdo->query($query); 
         
         $rows = $sql->fetchAll();
         
         return $rows[0][0];
    }
    
    //returns lowerbound from sql database based on $id.
    public function getLowerBound($id)
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
         
         $query = "SELECT lowerbound FROM WeightBrackets WHERE id = ".$id.";";
            
         $sql = $pdo->query($query); 
         
         $rows = $sql->fetchAll();
         
         return $rows[0][0];
    }
    
    public function getPrice($totalweight)
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
        
        $query="SELECT price FROM WeightBrackets WHERE lowerbound <=";
        $query .= ($totalweight-0.01);
        $query .= " AND upperbound >= ";
        $query .= $totalweight;
        $query .= ";";
        
        $sql = $pdo->query($query); 
         
        $rows = $sql->fetchAll();
         
        return $rows[0][0];
        
    }
    
    
    
}//end of Weight Store
    
?>