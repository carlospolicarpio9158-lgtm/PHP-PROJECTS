<?php
declare(strict_types=1);

$doughs = [
    'Original'   => ['price' => 25, 'stock' => 40],
    'Chocolate'  => ['price' => 35, 'stock' => 25],
    'Red Velvet' => ['price' => 39, 'stock' => 8],
    'Ube'        => ['price' => 38, 'stock' => 5],
    'Matcha'     => ['price' => 42, 'stock' => 15],
    'Cheese'     => ['price' => 36, 'stock' => 30],
];

$tax_rate = 12;

function get_reorder_message(int $stock): string
{
    return ($stock < 10) ? 'Yes' : 'No';
}

function get_total_value(float $price, int $quantity): float
{
    return $price * $quantity;
}

function get_tax_due(float $price, int $quantity, int $tax_rate = 0): float
{
    $total_value = $price * $quantity;
    return $total_value * ($tax_rate / 100);
}

<?php include 'footer.php'; ?>