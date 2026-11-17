<?php
include "header.php";
//1. INCLUDE: Load printing rates
include "rates.php";

//2. Customer Details
$customerName = "Juan Dela Cruz";
$customerType = "student";
$printType = "colored";
$pages = 5;
$copies = 3;
$paymentMethod = "cash";
$amountPaid = 150;

//3. Match: Determine price per page
$pricePerPage = match ($printType) {
    "blackwhite" => $blackWhiteRate,
    "colored" => $coloredRate,
    "photo" => $photoRate,
    default => 0
};

//4. Calculate the Subtotal
$subtotal = $pricePerPage * $pages * $copies;

//5. IF-ELSE-IF: Costumer Discount
if ($customerType === "student") {
    $discountRate = .10;
} elseif ($customerType === "faculty") {
    $discountRate = .05;
} else {
    $discountRate = 0;
}
$discount = $subtotal * $discountRate;
$total = $subtotal - $discount;

//6. SWITCH: Deter,ome Payment Method 
switch ($paymentMethod) {
    case "cash": 
        $paymentLabel = "Cash Payment"; break;

    case "gcash": 
        $paymentLabel = "GCash Payment"; break;
        
    default: 
    $paymentLabel = "Unknown Payment Method";
}

//7. Display Transaction
echo "<h1>Campus Printing Service</h1>";
echo "<p>Customer: $customerName </p>";
echo "<p>CustomerType: $customerType </p>";
echo "<p>PrintingType: $printType </p>";
echo "<p>Pages per Copy: $pages </p>";
echo "<p>Number of copies: $copies </p>";

echo "<hr>";

//8. FOR-LOOP: Display copy breakdown
echo "<h2>Printing Breakdown</h2>";

    for ($i = 1; $i <= $copies; $i++) {
            $copyCost = $pricePerPage * $pages;

        echo "Copy $i: P " .
            number_format($copyCost, 2) . "<br>";
}

//9. WHILE LOOP: Simulate
echo "<h2>Preparation Status</h2>";

$counter = 1;

while ($counter <= $copies) {
    echo "Preparing copy $counter of $copies<br>";
    $counter++;
}
//10. Display Bill
echo "<hr>";
echo "<p>Subtotal: P " .
    number_format($subtotal, 2) . "</p>";

echo "<p>Discount: P " .
    number_format($discount, 2) . "</p>";

echo "<h2>Total Bill: P " .
    number_format($total, 2) . "</h2>";

echo "<p>Payment Method: $paymentLabel</p>";

//11. IF-ELSE: Check Payment
if ($amountPaid >= $total) {
    $change = $amountPaid - $total;

    echo "<p>Payment Succesful!</p>";
    echo "<p>Change : P " .
            number_format($change, 2) . "</p>";
} else {
    $shortage = $total - $amountPaid;
    
    echo "<p>Insuffiecient Payment!</p>";
    echo "<p>Additional Payment Needed: P " . 
            number_format($shortage, 2) . "</p>";
}

include "footer.php";
?>