<?php

include 'AdministratorController.php';

//create a session
session_start();
//create new controller
$controller = new AdministratorController();

//display catalog
$controller-> displayAdministratorInterface();

?>