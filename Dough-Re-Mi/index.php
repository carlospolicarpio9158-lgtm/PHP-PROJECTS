<?php
require 'header.php';
require 'products.php';
include 'menu.php';
?>

<h2>Place Your Order</h2>

<form method="POST" action="process.php">
    <label>Name</label>
    <input name="customer_name" required>

    <label>Customer Type</label>
    <select name="customer_type">
        <?php
        foreach ($customerTypes as $value => $label) {
            echo '<option value="' . $value . '">' . $label . '</option>';
        }
        ?>
    </select>
    
    <label>Product</label>
    <select name="product">
        <?php
        foreach ($products as $code => $product) {
            echo '<option value="' . $code . '">' . $product['name'] . '</option>';
        }
        ?>
    </select>

    <label>Kilo/s</label>
    <input name="quantity" type="number" min="1" max="<?php echo $maxQuantity; ?>" required>

    <label>Toppings (optional)</label>
    <br>
    <?php
    
    foreach ($toppings as $code => $topping) {
        echo '<label>';
        echo '<input type="checkbox" name="toppings[]" value="' . $code . '">';
        echo $topping['iceCream'] . ' ice cream + ' . $topping['sauce'] . ' sauce';
        echo ' (&#8369;' . number_format($topping['price'], 2) . ')';
        echo '</label><br>';
    }
    ?>
    <br>
    <label>Budget (PHP)</label>
    <input name="budget" type="number" min="0" step="0.01" required>

    <button type="submit" id="process">Process Order</button>
</form>

<?php include 'footer.php'; ?>