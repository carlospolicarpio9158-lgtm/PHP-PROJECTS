<?php
require_once 'products.php';
?>
<h2>Available Menu</h2>

<table>
    <tr>
        <th>Code</th>
        <th>Product</th>
        <th>Prices</th>
    </tr>
    <?php
    foreach ($products as $code => $product) {
        echo '<tr>';
        echo '<td>' . $code . '</td>';
        echo '<td>' . $product['name'] . '</td>';
        echo '<td>&#8369;' . number_format($product['price'], 2) . ' per kilo</td>';
        echo '</tr>';
    }
    ?>
</table>

<p>Note: All prices vary depending on the quantity purchased.</p>

<h3>Toppings</h3>

<table>
    <tr>
        <th>Ice Cream</th>
        <th>Sauce</th>
        <th>Price</th>
    </tr>
    <?php
    foreach ($toppings as $topping) {
        echo '<tr>';
        echo '<td>' . $topping['iceCream'] . '</td>';
        echo '<td>' . $topping['sauce'] . '</td>';
        echo '<td>&#8369;' . number_format($topping['price'], 2) . '</td>';
        echo '</tr>';
    }
    ?>
</table>

<p>Note: All prices may vary on chosen combinations.</p>
