<?php

use PHPUnit\Framework\TestCase;
use App\Security\Csrf;

class CsrfTest extends TestCase
{
    public function testCreateTokenReturnsString(): void
    {
        $token = Csrf::csrf_token();
        $this->assertSame(64, strlen($token));
    }

    public function testTokenIsReused(): void
    {
        $token = Csrf::csrf_token();
        $token2 = Csrf::csrf_token();
        $this->assertSame($token, $token2);
    }

    public function testCsrfFieldHtml(): void
    {
        $field = Csrf::csrf_field();
        $this->assertStringContainsString('name="csrf_token"', $field);
        $this->assertStringContainsString('type="hidden"', $field);
    }
}