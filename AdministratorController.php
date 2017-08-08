<?php
/**
 * Controller class
 * @author Undergraduate Group One 
 */
 //associated with AdministratorInterface,
 //and OrderStore
 
include 'AdministratorInterface.php';
include 'OrderStore.php';
include 'WeightStore.php';

class AdministratorController
{
  var $adminInterface;
  var $orderStore;
  var $weightStore;
  
  public function __construct()
  {
      $this->orderStore = new OrderStore();
      $this->adminInterface = new AdministratorInterface();
      $this->weightStore = new WeightStore();
  }
  
  public function displayAdministratorInterface()
  {
      $this->adminInterface->displayAdministratorInterface();
  }
  
  public function searchByDate($lower,$upper)
  {
    return $this->orderStore->searchByDate($lower,$upper);
  }
  
  public function searchByStatus($status)
  {
    return $this->orderStore->searchByStatus($status);
  }
  
  public function searchByPrice($lower,$upper)
  {
    return $this->orderStore->searchByPrice($lower,$upper);
  }
  
  public function displayOrders($rows)
  {
    $this->adminInterface->displayOrders($rows);
  }
  
  public function displayWeightBrackets()
  {
    $query = "SELECT * FROM WeightBrackets;";
    $this->adminInterface->displayWeightBrackets($this->weightStore->accessWeightBrackets($query));
  }
  
  public function addNewWeightBracket($price,$lowerbound,$upperbound)
  {
    $this->weightStore->newWeightBracket($price,$lowerbound,$upperbound);
  }
  
  public function deleteWeightBracket($id)
  {
    $this->weightStore->deleteWeightBracket($id);
  }
  
  public function accessWeightBrackets($query)
  {
    return $this->weightStore->accessWeightBrackets($query);
  }
  
  public function editWeightBracket($price,$lowerbound,$upperbound,$id)
  {
    $this->weightStore->editWeightBracket($price,$lowerbound,$upperbound,$id);
  }
}
?>