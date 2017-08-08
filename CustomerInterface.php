<?php
/*
 * @author Undergraduate Group One
 * Boundary Class for Customers
 */

 //create a session
session_start();
class CustomerInterface
{
    //displays a catalog given $rows taken from the Legacy Product Database
    public function displayCatalog($rows)
    {
    
        echo "<body style='background-color: SteelBlue  ; color:White;  '>";
        $controller = new OrderController();
    
 
        //WHEN THE USER CLICKS ADD TO CART IT MUST RUN THROUGH THIS CHECK TO BE ABLE TO RUN ADD TO CART FUNCTION
        if (isset($_POST["Item_no"])) 
        {        
            if ($_POST['Quantity'] != 0) 
            {
                CustomerInterface::addToCart($_POST['Item_no'],$_POST['Quantity']);
            }
            else
            {
                echo "Error you entered zero for the quantity or did not specify a quantity.";
            }
        }
        
        //PAGE HEADER
        echo '<h1 align="center"> Parts Catalog </h1>';
        echo '<form method="post" action="Cart.php">';
        echo '<input required type="submit" name="checkout" value="Continue To Cart" />';
        echo '</form>';
        echo '<p align = "center">';
        
        
        //TABLE HEADERS
        echo '<table align="center" border="1">';
        echo "<th> Part # </th>";
        echo "<th> Description </th>";
        echo "<th> Price </th>";
        echo "<th> Weight </th>";
        echo "<th> Image </th>";
        echo '<th width:80px>Qty Available</th>';
        echo '<th width:80px>Qty Needed</th>';
        echo "<th> Add to Cart</th>";
        
        
        //POPULATE TABLE
        foreach($rows as $row)
        {
            echo "<form method ='post' action=''>";
            $image = "<img src=" . $row[4] . " />";
            echo '<tr align = "center"> 
                    <td align = "center">' . $row[0] . "</td>" .
                    "<td>" . $row[1] . "</td>" .
                    "<td>" . $row[2] . "</td>" .
                    "<td>" . $row[3] . "</td>" .
                    "<td>" . $image . "</td>"; 
                     echo '<td>';
                        $quantity = $controller->getQuantity($row[0]);
                        echo $quantity; 
                    echo '</td>';
                    echo '<td> <input required type="number" min="0" max="'.$quantity.'"name="Quantity" value=""> </td>';
                    echo '<td> <input required type="submit" value="Add to Cart" /> </td> 
                </tr>';
                //hidden value passes part number
                echo '<input required type="hidden" name="Item_no" value="'.$row[0].'">';
            echo "</form>";
        }//end of foreach
        echo "</table>";
        
        //CHECKOUT BUTTON
        echo '<form method="post" action="Cart.php">';
        echo '<input required type="submit" name="checkout" id="checkout" value="Continue To Cart" />';
        echo '</form>';
        echo "</p>";
        echo "</body>";
        }//end of display catalog
    
    //displays cart of selected items passed as $rows from selected items in the catalog
    public function displayCart($rows)
    {
        //Back to catalog BUTTON
        echo '<form method="post" action="index.php">';
        echo '<input required type="submit" name="checkout" id="checkout" value="Back To Catalog" />';
        echo '</form>';
        
        echo "<body style='background-color: Pink ; color: MidnightBlue '>";
        $partstore = new PartStore();
        $controller = new OrderController();
        
        //WHEN THE USER CLICKS Remove from cart IT MUST RUN THROUGH THIS CHECK TO BE ABLE TO RUN 
        if (isset($_POST["Item_no"])) 
        {        
            CustomerInterface::removeFromCart($_POST['Item_no']);
        }

         if($rows!=null)
        {
        //PAGE HEADER
        echo '<h1 align="center"> Shopping Cart </h1>';
        echo '<p align = "center">';
        
        //TABLE HEADERS
        echo '<table align="center" border="1">';
        echo "<th> Part # </th>";
        echo "<th> Description </th>";
        echo "<th> Price </th>";
        echo "<th> Weight </th>";
        echo "<th> Image </th>";
        echo '<th width:80px>Qty Available</th>';
        echo "<th> Remove From Cart</th>";
        echo "<th> Quantity Requested </th>";
        
        $totalprice = 0;
        $totalweight = 0;
        
        //POPULATE TABLE
        foreach($rows as $row)
        {
            echo "<form method ='post' action=''>";
            $image = "<img src=" . $row[4] . " />";
            echo '<tr align = "center"> 
                    <td align = "center">' . $row[0] . "</td>" .
                    "<td>" . $row[1] . "</td>" .
                    "<td>" . $row[2] . "</td>" .
                    "<td>" . $row[3] . "</td>" .
                    "<td>" . $image . "</td>"; 
                    echo '<td>'; 
                        $quantity = $controller->getQuantity($row[0]);
                        echo $quantity;
                    echo '</td>';
                    $quantity = $controller->getQuantity($row[0]);
                    echo '<td> <input required type="submit" id="checkout" value="Remove From Cart" /> </td>';
                    echo '<td>';
                        echo $requested = $partstore->get_quantity($row[0]);
                    echo '</td>';
                    //hidden value passes part number
                    echo '<input required type="hidden" name="Item_no" value="'.$row[0].'">';
            echo "</form>";
            $subtotal = $subtotal + ($row[2] * $requested);
            $totalweight = $totalweight + ($row[3] * $requested);
            
        }//end of foreach
        
        //PRICING IS DONE HERE
        //SUBTOTAL
        echo '<h2 align="center">Subtotal: ';
        echo "$";
        echo number_format((float) $subtotal, 2);
        echo '</h2>';
        
        $controller = new OrderController();
        
        //SHIPPING COSTS
        echo '<h3 align="center">Shipping: ';
        $shipping=$controller->getPrice($totalweight);
        echo "$";
        echo number_format((float) $shipping, 2);
        echo '</h3>';
        
        //TOTAL PRICE
        echo '<h2 align="center">Total: ';
        echo "$";
        echo number_format((float) ($subtotal + $shipping), 2);
        echo '</h2>';
        
        //save in session for later use
        $_SESSION["totalprice"] = $subtotal + $shipping; 
        
        
        //CHECKOUT BUTTON
        echo '<form method="post" action="ShippingCheckout.php">';
        echo '<input required type="submit" name="checkout" value="Continue To Shipping Info" />';
        echo '</form>';
          }//end of if statement
          
        else //otherwise if it returns null, the cart is empty 
        {
            echo "<table border = 1>";
            echo '<h1 align = "center" >YOUR SHOPPING CART IS EMPTY! </h1>';
            echo "</table>";
        }
        
        echo '</table>';
        echo "</p>";
        echo '</body>';

    }//end of display cart
    
    //adds items to cart, implemented in SQL database
    public function addToCart($item, $quantity)
    {
        //create new controller
        $controller = new OrderController();

        //display catalog
        $query = "INSERT INTO Part VALUES(";
        $query .= $item;
        $query .= ",";
        $query .= $quantity;
        $query .= ");";
        
        $rows=$controller->addToCart($query);
    }
    
    //removes item from cart, implemented in SQL database
    public function removeFromCart($item)
    {
        //create new controller
        $controller = new OrderController();                                
                                                                            
        //display catalog                                                   
        $query = "DELETE FROM Part WHERE part_no = ";                   
        $query .= $item;                                                    
        $query .= ";";

        $rows=$controller->removeFromCart($query);
        header("Refresh:0");//will refresh the screen
    }
    
    
    //prompts user for shipping information
    public function displayShippingCheckout()
    {  
        echo "<body style='background-color: Salmon ; color: White   '>";
     //Back to cart BUTTON
     if (!isset($_POST['submit']))
         {           
            echo '<form method="post" action="Cart.php">';
            echo '<input type="submit" value="Back To Cart" />';
            echo '</form>';
         
            echo '<p align = "center">';
            echo '<h1 align="center"> Enter Your Shipping Information </h1>';
            echo '<form method="post" action="">';
            echo '<table align="center" border=1>';
            echo '<tr><td>First Name:</td> <td><input required type="text" name="fname"></td></tr>';
            echo '<tr><td>Last Name: </td><td><input required type="text" name="lname" ></td></tr>';
            echo '<tr><td>Address:</td> <td><input required type="text" name="addressline"></td></tr>';
            echo '<tr><td>City: </td><td><input required type="text" name="city"></td></tr>';
            echo '<tr><td>State: </td><td><input required type="text" name="state"</td></tr>';
            echo '<tr><td>Zip Code:</td> <td><input required type="text" name="zipcode"</td></tr>';
            echo '<tr><td>Email:</td><td> <input required type="text" name="email"></td></tr>';
            echo '</table>';
                     
            echo '<input type="submit" name="submit" align="center" value="Comfirm Shipping Information" />';
            echo '</form>';
            echo '</p>';
     }
         
         if (isset($_POST['submit']))
         { 
             echo '<h2 align="center"> Shipping Information Comfirmed </h2>';          
             //concatenate shipping address
             $shippingaddress = $_POST["addressline"];
             $shippingaddress .= ", ";
             $shippingaddress .= $_POST["city"];
             $shippingaddress .= ", ";
             $shippingaddress .= $_POST["state"];
             $shippingaddress .= " ";
             $shippingaddress .= $_POST["zipcode"];
             
             //assign session variables
             $_SESSION["fname"] = $_POST["fname"];
             $_SESSION["lname"] = $_POST["lname"];
             $_SESSION["address"] = $shippingaddress;
             $_SESSION["email"] = $_POST["email"];
              
             echo '<form method="post" action="CreditCardCheckout.php">';
             echo '<input type="submit" value="Continue to Billing Information" />';
             echo '</form>'; 
          }
            echo '</body>';
    } 
    
 
   //ask for credit card information
   public function displayCreditCardCheckout()
    {
      echo "<body style='background-color: DimGray ; color: LightCoral   '>"; 
     //Back to shipping BUTTON   
      echo '<form method="post" action="ShippingCheckout.php">';
      echo '<input type="submit" value="Back To Shipping" />';
      echo '</form>';
       
      echo '<p align = "center">';
      echo '<h1 align="center"> Enter Your Credit Card Information </h1>';
      echo '<form method="post" action="">';
      echo '<table align="center">';
      
      echo '<tr>
                <td>First Name: </td> 
                <td><input required type="text" maxlength="96" size="96" name="ccfname"></td>
            </tr>';
      echo '<tr>
                <td>Last Name: </td>
                <td><input required type="text" maxlength="96" size="96" name="cclname"></td>
            </tr>';
      //We broke credit card number down into four 4-digit numbers to properly format it for passing into CCProcessInterface
      echo '<tr>
                <td>Credit Card Number: </td> 
                <td> <input required type="number" min=0 size="9999" name="ccnum1">' . " " .
                '<input required type="number" min=0 size="9999" name="ccnum2">' . " " .
                '<input required type="number" min=0 size="9999" name="ccnum3">' . " " .
                '<input required type="number" min=0 name="ccnum4"></td> 
            </tr>';
      echo '<tr><td>Expiration Date</td>';
      echo '<td>Month: <select name="month">';
        //dropdown for month
         for($int=1; $int<13; $int++)
         {
           echo '<option value="'.$int.'">';
           echo $int;
           echo '</option>';
         }
           echo '</select>' . " " ;
           echo 'Year: <select name="year">';
         //dropdown for year
         for($int=2017; $int<2030; $int++)
         {
           echo '<option value="'.$int.'">';
           echo $int;
           echo '</option>';
         }
         
         echo '</select>';
         echo '</td></tr>';
           
         echo '</table>';
         echo '<input required type="submit" name="submit" "align="center" value="Comfirm Credit Card Information" />';
         echo '</form>';
         echo '</p>';
         
         $name = $_POST["ccfname"]." ".$_POST["cclname"];
         //concatenate credit card number
         $creditCardNum = $_POST["ccnum1"];
         $creditCardNum .= " ";
         $creditCardNum .= $_POST["ccnum2"];
         $creditCardNum .= " ";
         $creditCardNum .= $_POST["ccnum3"];
         $creditCardNum .= " ";
         $creditCardNum .= $_POST["ccnum4"];
         
         $exp = sprintf('%02d',$_POST["month"]);
         $exp .= '/';
         $exp .= $_POST["year"];
         
         $amt = $_SESSION["totalprice"];

     
         if (isset($_POST['submit']))
         {  
         $controller = new OrderController();
         $auth = $controller->validateCard($creditCardNum, $name, $exp, $amt,$_POST["ccnum4"]);
          
         
             if($auth)
             {       
                echo '<form method="post" action="CompleteCheckout.php">';
                echo '<input required type="submit" value="Continue" />';
                echo '</form>'; 
             }
         }
         echo '</body>';
         
    }//end of displayCustomerCreditCard
    
    //displays final confirmation for customer
    public function displayPlaceOrder()
    {
         echo "<body style='background-color: LightCoral ; color:  Moccasin  '>";
    //Back to shipping BUTTON
    if (!isset($_POST['place']))
         {
             echo '<form method="post" action="CreditCardCheckout.php">';
             echo '<input type="submit" value="Back To Payment" />';
             echo '</form>';
         }
         
         echo '<p align = "center">';
         echo '<h1 align="center"> Order Information </h1>';
         echo '<form method="post" action="">';
         echo '<table align="center" border=1>';
         echo '<tr>
                    <td>First Name: </td> <td>';
                    echo $_SESSION["fname"];
                    echo '</td></tr>';
         echo '<tr>
                    <td>Last Name: </td><td>';
                    echo $_SESSION["lname"];
                    echo '</td></tr>';
         echo '<tr>
                    <td>Address: </td><td>';
                    echo $_SESSION["address"];
                    echo '</td></tr>';
        echo '<tr>
                    <td>Email: </td><td>';
                    echo $_SESSION["email"];
                    echo '</td></tr>';
         echo '<tr>
                    <td>Payment Type: </td><td>';
                    echo $_SESSION["payment"];
                    echo '</td></tr>';
         echo '<tr>
                    <td>Total: </td><td>';
                    echo "$";
                    echo number_format((float) $_SESSION["totalprice"], 2);
                    echo '</td></tr>';
         echo '</table>';
         echo '</p>';
         
         //display button if not pressed
         if (!isset($_POST['place']))
         {
            echo '<form method="post" action="">';
            echo '<input type="submit" name="place" value="Place Order" />';
            echo '</form>';
         }
         
        //display "confirmation email" if button is pressed
        if (isset($_POST['place']))
        {   
           $controller = new OrderController();         
           //send email
           $controller->sendConfirmationEmail($_SESSION["email"]); 
           //create a new order with session variables, add to SQL database
           $controller->newOrder($_SESSION["totalprice"],$_SESSION["fname"],$_SESSION["lname"],$_SESSION["address"],$_SESSION["email"]);            
           
           $query = "SELECT * FROM Part";
           //update inventory
           $controller->updateInventory($query);
           //empty cart
           $controller->emptyCart();   
        }
         echo '</body>';
         
    }//end of place order
    
    //claims that an email has been sent, but no email is ACTUALLY sent...
    public function sendConfirmationEmail($email,$orderNo)
    {
      /* THIS CODE CANNOT RUN ON TURING/HOPPER
        $msg = "Thank you for purchasing parts through our system!\n
                This is your order confirmation. Your order number is:\n
                ".$orderNo;
        mail($email,"Parts Shipping Confirmation",$msg);
      */
      $orderNo += 1;
      
      echo '<h1 align="center">Your order is confirmed, a confirmation email has been sent!</h1>';
      echo '<br /><h2 align="center">email address: '.$email.'  order number: '.$orderNo.' </h2>';
      
    }
}//end of customer interface class
?>
