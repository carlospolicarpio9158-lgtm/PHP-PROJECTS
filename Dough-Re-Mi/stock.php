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
include 'header.php';
?>

<h2>Stock Control</h2>

<table>
    <tr>
        <th>Product</th>
        <th>Stock</th>
        <th>Re-order</th>
        <th>Total Value</th>
        <th>Tax Due</th>
    </tr>
<?php foreach ($doughs as $product_name => $data) { ?>
        <tr>
            <td><?php echo $product_name; ?></td>
            <td><?php echo $data['stock']; ?></td>
            <td><?php echo get_reorder_message($data['stock']); ?></td>
            <td>PHP <?php echo number_format(get_total_value($data['price'], $data['stock']), 2); ?></td>
            <td>PHP <?php echo number_format(get_tax_due($data['price'], $data['stock'], $tax_rate), 2); ?></td>
        </tr>
    <?php } ?>
</table>

<?php include 'footer.php'; ?>
