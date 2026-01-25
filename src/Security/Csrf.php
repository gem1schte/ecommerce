<?php

/**
 * @return string CSRF Token
 */
function csrf_token()
{
    if (empty($_SESSION['csrf_token'])) {
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
    if (!isset($_SESSION['csrf_token']) || !hash_equals($token, $_SESSION['csrf_token'])) {
        write_log("CSRF validation failed in $fail_doc", 'WARNING');
        redirect_to(WEBSITE_URL . $fail_url);
    }
    // unset($_SESSION['csrf_token']);
}