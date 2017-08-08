<?php
/* @author Undergraduate Group One
 * Controller Object for Shipping use case
 */

include 'OrderStore.php';
include 'ShippingInterface.php';
include 'LegacyProductDBInterface.php';

class ShippingController
{
  var $orderStore;
  var $shippingInterface;
  var $legacyInterface;

  public function __construct()
  {
    $this->orderStore = new OrderStore();
    $this->legacyInterface = new LegacyProductDBInterface();
    $this->shippingInterface = new ShippingInterface();
  }
  public function getPendingOrders()
  {
    return $this->orderStore->searchByStatus("pending");
  }
  public function displayPendingOrders($rows)
  {
    $this->shippingInterface->displayPendingOrders($rows);
  }
  
  public function getOrderDetails($orderNum)
  {
    return $this->orderStore->getOrderDetails($orderNum);
  }
  
  //saves relevant info in session variables...
  public function saveOrderDetails($rows)
  {
    $this->orderStore->saveOrderDetails($rows);
  }
  
  public function displayOrderDetails($rows)
  {
    $this->shippingInterface->displayOrderDetails($rows);
  }
  
  //gets part information from legacy DB
  public function mergeOrderDetails($query)
  {
    return $this->partStore->accessDatabase($query);
  }
  public function shippingSearchDatabase($partNumArray)
  {
    return $this->legacyInterface->shippingSearchDatabase($partNumArray);
  }
  
  public function setShipped($orderNum)
  {
    return $this->orderStore->setShipped($orderNum);
  }

}
?>