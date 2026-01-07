<?php

function create_uid()
{
    return 'user_' . bin2hex(random_bytes(16));
}

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
    if (!$stmt){
        write_log("Prepare failed:" . $conn->error, 'ERROR');
        return;
    }
    $stmt->bind_param('iii', $purchase_qty, $product_id, $purchase_qty);
    $stmt->execute();
    if(!$stmt){
        write_log("Execute failed:" . $stmt->error, 'ERROR');
        return;
    }
}

/**  
 * @param string $error_msg Error message
 * @param string $level Log level,default is 'INFO'
 * @return void
 */
function write_log($error_msg, $level = 'INFO')
{
    $date = date('Y-m');
    $file = __DIR__ . '/../../logs/' . $date . '.txt';
    $dir = dirname($file);

    if (!file_exists($dir)) {
        mkdir($dir, 0777, true);
    }

    $times = date('Y-m-d H:i:s');
    $entry_log = "[$times] [$level] $error_msg" . PHP_EOL;
    file_put_contents($file, $entry_log, FILE_APPEND | LOCK_EX);
}

/** 
 * @param string $lang select language
 * @return string URL with selected language params
 */
function select_lang($lang)
{
    $params = $_GET;
    $params['lang'] = $lang;
    return basename($_SERVER['PHP_SELF']) . '?' . http_build_query($params);
}

/**
 * @param string $url URL to redirect
 * @return void
 */
function redirect_to($url)
{
    header("Location: $url");
    exit();
}

/**
 * Data Source https://www.apicountries.com/countries
 * @return array list of all countries
 */
function all_countries()
{
    global $conn;
    $sql = "SELECT * FROM countries ORDER BY name ASC";
    $stmt = $conn->prepare($sql);
    if (! $stmt){
        write_log("Prepare filed:" . $conn->error, 'ERROR');
        return [];
    }
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

/**
 * @return string CSRF Token
 */
function csrf_token()
{
    if (empty($_SESSION['csrf_token']))
    {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * @param string $token Ver CSRF Token
 * @return void
 */
function ver_csrf($token, $fail_url = null, $fail_doc = " ")
{
    if(!isset($_SESSION['csrf_token']) || !hash_equals($token, $_SESSION['csrf_token']))
    {
        write_log("CSRF validation failed in $fail_doc", 'WARNING');
        redirect_to(WEBSITE_URL . $fail_url);
    }
    // unset($_SESSION['csrf_token']);
}
