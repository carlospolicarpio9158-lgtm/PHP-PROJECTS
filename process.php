<?php
require 'products.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: index.php');
    exit;
}
$name     = $_POST['customer_name'];
$type     = $_POST['customer_type'];
$code     = $_POST['product'];
$quantity = (int) $_POST['quantity'];
$budget   = (float) $_POST['budget'];
$chosen   = $_POST['toppings'] ?? [];

?>