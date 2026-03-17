<?php

namespace App\Security;

use App\Utils\Helper;

class Csrf
{
    /**
     * Generate a CSRF token and store it in the session if it does not exist.
     * 
     * @return string CSRF Token
     */
    public static function csrf_token(): string
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    /**
     * Verify the CSRF token against the session token.
     * 
     * @param string|null $token CSRF token provided by the request
     * @return bool True if the token is valid
     */
    public static function verify_token(?string $token): bool
    {
        if (!isset($_SESSION['csrf_token']) || !is_string($_SESSION['csrf_token']) || $token === null){
            return false;
        }
        return hash_equals($_SESSION['csrf_token'], $token);
    }

    /**
     * Validate CSRF token and redirect if validation fails.
     * 
     * @param string|null $token CSRF token from request
     * @param string|null $fail_url Redirect path when validation fails
     * @param string $fail_doc Document name used for logging
     * @return void
     */
    public static function ver_csrf(?string $token, ?string $fail_url = null, string $fail_doc = ""): void
    {
        if (!self::verify_token($token))
        {
            Helper::write_log("CSRF validation failed in $fail_doc", 'WARNING');
            Helper::redirect_to(WEBSITE_URL . ($fail_url ?? ''));
        }
    }

    /**
     * Generate a hidden HTML input field containing the CSRF token.
     * 
     * @return string HTML hidden input field containing the CSRF token
     */
    public static function csrf_field(): string
    {
        $token = self::csrf_token();
        return '<input type="hidden" name="csrf_token" value="'. 
        htmlspecialchars($token, ENT_QUOTES, 'UTF-8') .'">';
    }
}
