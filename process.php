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

switch ($type) {
    case 'student':
        echo '<p>Student discount: 10% off the dough.</p>';
        break;
    case 'faculty':
        echo '<p>Faculty discount: 5% off the dough.</p>';
        break;
    default:
        echo '<p>No discount for guests.</p>';
}

echo '<h3>Items Ordered</h3>';
for ($i = 1; $i <= $quantity; $i++) {
    echo '<p>Kilo ' . $i . ': ' . $productName . ' - PHP ' . number_format($price, 2) . '</p>';
}

if (count($toppingsList) > 0) {
    echo '<h3>Toppings</h3>';
    echo '<table>';
    echo '<tr><th>Ice Cream</th><th>Sauce</th><th>Price</th></tr>';
    foreach ($toppingsList as $topping) {
        echo '<tr>';
        echo '<td>' . $topping['iceCream'] . '</td>';
        echo '<td>' . $topping['sauce'] . '</td>';
        echo '<td>PHP ' . number_format($topping['price'], 2) . '</td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo '<p>No toppings selected.</p>';
}

echo '<p>Dough: PHP ' . number_format($subtotal, 2) . '</p>';
echo '<p>Discount: PHP ' . number_format($discount, 2) . '</p>';
echo '<p>Toppings: PHP ' . number_format($toppingsTotal, 2) . '</p>';
echo '<h3>Final Bill: PHP ' . number_format($total, 2) . '</h3>';
echo '<p>Budget: PHP ' . number_format($budget, 2) . '</p>';

$status = ($budget >= $total) ? 'sufficient' : 'not enough';
echo '<p>Budget is ' . $status . '.</p>';

if ($budget >= $total) {
    $balance = $budget - $total;
    echo '<p class="success">Balance: PHP ' . number_format($balance, 2) . '</p>';
    echo '<h3>Change</h3>';
    $change = (int) $balance;
    $i = 0;
    do {
        $count = intdiv($change, $denominations[$i]);
        if ($count > 0) {
            echo '<p>' . $count . ' x PHP ' . $denominations[$i] . '</p>';
        }
        $change = $change % $denominations[$i];
        $i++;
    } while ($change > 0);
} else {
    echo '<p class="error">Shortage: PHP ' . number_format($total - $budget, 2) . '</p>';
}

echo '<h3>Preparation Progress</h3>';
$counter = 1;
while ($counter <= $quantity) {
    echo '<p>Preparing kilo ' . $counter . ' of ' . $quantity . '</p>';
    $counter++;
}

echo '<p><a href="index.php">Scoop another order Dough!</a></p>';
include 'footer.php';