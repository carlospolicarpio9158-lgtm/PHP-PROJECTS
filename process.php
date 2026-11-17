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

if (!isset($products[$code]) || !isset($customerTypes[$type]) || $quantity < 1 || $quantity > $maxQuantity) {
    include 'header.php';
    echo '<p class="error">Invalid order. Please check your input.</p>';
    echo '<a href="index.php">Return to form</a>';
    include 'footer.php';
    exit;
}
$productName = $products[$code]['name'];
$price       = $products[$code]['price'];
$subtotal    = $price * $quantity;

$rate = match ($type) {
    'student' => 0.10,
    'faculty' => 0.05,
    default   => 0,
};
$discount = $subtotal * $rate;

$toppingsTotal = 0;
$toppingsList  = [];
foreach ($chosen as $toppingCode) {
    if (isset($toppings[$toppingCode])) {
        $toppingsTotal += $toppings[$toppingCode]['price'];
        $toppingsList[] = $toppings[$toppingCode];
    }
}
$total = $subtotal - $discount + $toppingsTotal;
include 'header.php';

echo '<h2>Order Receipt</h2>';
echo '<p>Customer: ' . htmlspecialchars($name) . '</p>';
echo '<p>Customer type: ' . $customerTypes[$type] . '</p>';
?>