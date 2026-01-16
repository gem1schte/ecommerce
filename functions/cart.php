<?php
function add_product_to_cart($product_id, $quantity)
{
    $product_id = filter_var($product_id, FILTER_SANITIZE_NUMBER_INT);
    $quantity = filter_var($quantity, FILTER_SANITIZE_NUMBER_INT);

    if ($product_id > 0 && $quantity > 0) {
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id] += $quantity;

            // Add item to session cart, max qty = 5
            if ($_SESSION['cart'][$product_id] > 5) {
                $_SESSION['cart'][$product_id] = 5;
            }
        } else {
            $_SESSION['cart'][$product_id] = $quantity;
        }
    }
}

function remove_cart_product($product_id)
{
    $product_id = filter_var($product_id, FILTER_SANITIZE_NUMBER_INT);
    unset($_SESSION['cart'][$product_id]);
}

function delete_cart_qty($product_id, $quantity)
{
    $product_id = filter_var($product_id, FILTER_SANITIZE_NUMBER_INT);
    $quantity = filter_var($quantity, FILTER_SANITIZE_NUMBER_INT);

    if ($product_id > 0 && $quantity > 0 && isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] -= $quantity;
    }

    if ($_SESSION['cart'][$product_id] <= 0) {
        unset($_SESSION['cart'][$product_id]);
    }
}

/**
 * @param float $price Unit price
 * @param int $qty Quantity
 * @param float $tax Tax rate,default 5%
 * @return array{subtotal: float, tax: float, total: float}
 */
function calc_cart_totals($price, $qty, $tax = 0.05)
{

    $subtotal = $price * $qty;
    $tax = $subtotal * $tax;
    $total = $subtotal + $tax;

    return [
        'subtotal' => $subtotal,
        'tax' => $tax,
        'total' => $total,
    ];
}

/**
 * @param int $product_id Product Id
 * @param int $quantity Product Quantity
 * @return void
 */
function update_product_stock($product_id, $purchase_qty)
{
    global $conn;
    $update = "UPDATE products SET stock = stock - ? WHERE product_id = ? AND stock >= ?";
    $stmt = $conn->prepare($update);
    if (!$stmt) {
        write_log("Prepare failed:" . $conn->error, 'ERROR');
        return;
    }
    $stmt->bind_param('iii', $purchase_qty, $product_id, $purchase_qty);
    $stmt->execute();
    if (!$stmt) {
        write_log("Execute failed:" . $stmt->error, 'ERROR');
        return;
    }
}