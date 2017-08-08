<?php
/**
 * Controller class
 * @author Undergraduate Group One 
 */
 //associated with LegacyDBInterface, CustomerInterface,
 // PartStore, OrderStore, and CCInterface
 
 //create a session
session_start();
include 'CustomerInterface.php';
include 'LegacyProductDBInterface.php';
include 'PartStore.php';
include 'OrderStore.php';
include 'CCProcessInterface.php';
include 'WeightStore.php';

class OrderController
{
  var $customerInterface;
  var $productDBInterface;
  var $partStore;
  var $orderStore;
  var $ccProcessInterface;
  var $weightstore;
  
  function __construct()
  {
      $this->customerInterface = new customerInterface();
      $this->productDBInterface = new LegacyProductDBInterface();
      $this->partStore = new PartStore();
      $this->orderStore = new OrderStore();
      $this->weightstore = new WeightStore();
      $this->ccProcessInterface = new CCProcessInterface();
  }
  
  //returns $rows, a collection of all rows in the Legacy Product DB
  public function updateInventory($query)
  {
      $this->partStore->updateInventory($this->partStore->accessPartStoreDatabase($query));
  }
  
  public function emptyCart()
  {
      $this->partStore->emptyCart();
  }
  
  public function accessCatalog($query)
  {
      return $this->productDBInterface->accessDatabase($query);
  }
  
  public function searchCatalog($partNumArray)
  {
      return $this->productDBInterface->searchproductDBInterface($partNumArray);
  }

  public function displayCatalog($rows)
  {
      return $this->customerInterface->displayCatalog($rows);
  }
  
  public function accessCart()
  {
      return $this->productDBInterface->accessCart();
  }
  
  public function addToCart($query)
  {
      return $this->productDBInterface->addToCart($query);
  }
  
  public function removeFromCart($query)
  {
      return $this->partStore->removeFromDatabase($query);
  }
    public function displayCart($query)
  {
      return $this->customerInterface->displayCart($query);
  }
   public function cancelOrder()
   {
      return $this->partStore->cancelOrder();
   }
    public function displayShippingCheckout()
  {
      return $this->customerInterface->displayShippingCheckout();
  }
    public function displayNameCheckout()
  {
      return $this->customerInterface->displayNameCheckout();
  }
     public function displayBillingCheckout()
  {
      return $this->customerInterface->displayBillingCheckout();
  } 
     public function displayCreditCardCheckout()
  {
      return $this->customerInterface->displayCreditCardCheckout();
  } 
       public function setShipping($shippingaddress,$email)
  {
      return $this->orderStore->setShipping($shippingaddress,$email);
  }
   public function displayPlaceOrder()
  {
      $this->customerInterface->displayPlaceOrder();
  }
   public function calculateShipping($totalweight)
  {
      return $this->weightstore->calculateShipping($totalweight);
  }  
  public function setBilling($billingaddress)
  {
      return $this->orderStore->setBilling($billingaddress);
  } 
    public function newOrder($total,$fname,$lname,$address,$email)
  {
    return $this->orderStore->newOrder($total,$fname,$lname,$address,$email);
  }
  public function accessOrderStore($query)
  {
  return $this->orderStore->accessOrderStoreDatabase($query);
  }
   public function accessPartStore($query)
  {
   return $this->partStore->accessPartStoreDatabase($query);
  }
  public function validateCard($creditCardNum, $name, $exp, $amt, $last4)
  {
      return $this->ccProcessInterface->validateCard($creditCardNum, $name, $exp, $amt, $last4);
  }
  public function sendConfirmationEmail($email)
  {
      $this->customerInterface->sendConfirmationEmail($email,OrderStore::getLastOrderNumber());
  }
  public function getQuantity($ordernum)
  {
    return $this->partStore->getQuantity($ordernum);
  }
  
  public function getPrice($totalweight)
  {
    return $this->weightstore->getPrice($totalweight);
  }
}
?>