<?php     
    
        $dsn = "mysql:host=blitz.cs.niu.edu;dbname=csci467";
        $username = "student";
        $password = "student";
        try
        {
            $pdo = new PDO($dsn, $username, $password);
        }//end of try
  
        catch(PDOexception $e)
        {
            echo $e->getMessage();
        }//end of catch
    
    
        $dsn2 = "mysql:host=courses;dbname=z1808910";
        $username2 = "z1808910";
        $password2 = "1994Aug19";    
        try
        {
            $pdo2 = new PDO($dsn2, $username2, $password2);
        }//end of try
  
        catch(PDOexception $e) 
        {
            echo $e->getMessage();
        }//end of catch
        
        
              
        $query = "SELECT * from parts;";
        $sql = $pdo->query($query); 
        $rows = $sql->fetchAll();
    
      
        foreach($rows as $value)
        {
        $number = rand (2,15);
        $query = "INSERT INTO PartInventory VALUES(";
        $query .= $value[0];
        $query .= ",";
        $query .= "$number";
        $query .= ");";
        
        $sql2 = $pdo2->query($query); 
        
        }
?>