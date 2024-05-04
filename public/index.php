<?php
require_once '../app/View/View.php';

$view = new View();
$view->showProducts();
$view->showCategories();
$view->showSuppliers();
$view->showTransactions();
?>
