<?php
/* Controller class for Receiving Use Case
 * @author Undergraduate Group One
 */
include 'PartStore.php';
include 'LegacyProductDBInterface.php';
include 'ReceivingInterface.php';

class ReceivingController
{
  var $legacyInterface;
  var $partStore;
  var $receivingInterface;
  
  public function __construct()
  {
    $this->legacyInterface = new LegacyProductDBInterface();
    $this->partStore = new PartStore();
    $this->receivingInterface = new ReceivingInterface();
  } 
  public function displayMainInterface()
  {
    $this->receivingInterface->displayMainInterface();
  }
  
  public function accessDatabase($query)
  {
    return $this->legacyInterface->accessDatabase($query);
  }
  
  public function displayResults($rows)
  {
    $this->receivingInterface->displayResults($rows);
  }
  public function updateQuantity($partNum, $quantity)
  {
    $this->partStore->receivingUpdateInventory($partNum,$quantity);
  }
}


?>