<?php
//create a session
session_start();
class CCProcessInterface
{
    //validates a credit card with cc number, name, expiration date, and amount of purchase.
    //returns true if successful, false if unsuccessful
    //updates transaction number at the end
    public function validateCard($creditCardNum, $name, $exp, $amt, $last4)
    {
        //this code obtained from BlackBoard
        $transactionNum = CCProcessInterface::getTransactionNumber();
        $url = 'http://blitz.cs.niu.edu/CreditCard/';
        $data = array(
        	'vendor' => 'VE001-99',
        	'trans' => $transactionNum,
        	'cc' => $creditCardNum,
        	'name' => $name, 
        	'exp' => $exp, 
        	'amount' => $amt);
        
        $options = array(
            'http' => array(
                'header' => array(
                     'Content-type: application/json'
                   , 'Accept: application/json'),
                'method' => 'POST',
                'content'=> json_encode($data)
            )
        );
        
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        
        //search for "errors" in $result
        $auth = json_decode($result);
        
        
        //success, errors not found and $auth is not empty
        if(!isset($auth->{"errors"}))
        {
         $_SESSION["payment"] = '****-****-****-';
         $_SESSION["payment"] .= $last4;
          echo "card validated";
          CCProcessInterface::updateTransactionNumber($transactionNum);
          return true;
          //update current transacton number
          
        }
        //else failure
        else
        {
          echo "card failed to validate: ".$auth->{"errors"}[0];
          return false;
        }
        
    }
    
    //returns next transaction number
    public static function getTransactionNumber()
    {
        //CONNECT TO SYSTEM DATABASE
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
        //END CONNECT TO SYSTEM DATABASE
    
        //run sql query
        $sql = $pdo->query("select * FROM cctransnum ORDER BY num DESC LIMIT 1;"); 
        $rows = $sql->fetchAll();
        
        return $rows[0][0];
    }
    
    //updates database to hold next transaction number
    public static function updateTransactionNumber($currentTransNum)
    {
        //add one to current transaction number
        $one = 1;
        $newTransNum = $currentTransNum + $one;
        
        //CONNECT TO SYSTEM DATABASE
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
        //END CONNECT TO SYSTEM DATABASE
        
        //run sql query
        $sql = $pdo->query("UPDATE cctransnum SET num = ".$newTransNum." WHERE num = " .$currentTransNum.";");
    }
}

?>