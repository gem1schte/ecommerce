<?php

use PHPUnit\Framework\TestCase;
use App\Services\CartService;

final class CartServiceTest extends TestCase
{
    private mysqli $conn;
    private CartService $cart;

    protected function setUp(): void
    {
        parent::setUp();
        $_SESSION["cart"] = [];
        $this->conn = $this->createMock(mysqli::class);
        $this->cart = new CartService($this->conn);
    }

    protected function tearDown(): void
    {
        unset($_SESSION["cart"]);
        parent::tearDown();
    }

    public function testProductAddedToCart(): void
    {
        $p_ID = 1;
        $qty = 2;
        $this->cart->add_product_to_cart($p_ID, $qty);
        $this->assertSame($qty, $_SESSION["cart"][$p_ID]);
    }

    public function testProductQuantityAccumulatesToMaxLimit(): void
    {
        $p_ID = 1;
        $max = 5;
        $this->cart->add_product_to_cart($p_ID, 2);
        $this->cart->add_product_to_cart($p_ID, 3);
        $this->assertSame($max, $_SESSION["cart"][$p_ID]);
    }

    public function testProductQuantityWillNotExceedFive(): void
    {
        $p_ID = 1;
        $max = 5;
        $this->cart->add_product_to_cart($p_ID, 6);
        $this->assertSame($max, $_SESSION["cart"][$p_ID]);
    }

    public function testProductQuantityAccumulationExceedsMaxLimit(): void
    {
            $p_ID = 1;
            $max = 5;
            $this->cart->add_product_to_cart($p_ID, 3);
            $this->cart->add_product_to_cart($p_ID, 3);
            $this->assertSame($max, $_SESSION["cart"][$p_ID]);
    }

    public function testProductRemovedFromCart(): void
    {
        $p_ID = 1;
        $qty = 2;
        $this->cart->add_product_to_cart($p_ID, $qty);
        $this->cart->remove_cart_product($p_ID);
        $this->assertArrayNotHasKey($p_ID, $_SESSION["cart"]);
    }

    public function testDeleteProductQtyReducesQuantity(): void
    {
        $p_ID = 1;
        $qty = 2;
        $this->cart->add_product_to_cart($p_ID, $qty);
        $this->cart->delete_cart_qty($p_ID, 1);
        $this->assertSame(1, $_SESSION["cart"][$p_ID]);
    }

    public function testDeleteProductQtyRemovesItemWhenQuantityBecomesZero(): void
    {
        $p_ID = 1;
        $qty = 2;
        $this->cart->add_product_to_cart($p_ID, $qty);
        $this->cart->delete_cart_qty($p_ID, $qty);
        $this->assertArrayNotHasKey($p_ID, $_SESSION["cart"]);
    }

    public function testCalcCartTotalsReturnsCorrectValues(): void
    {
        $total = $this->cart->calc_cart_totals(100.0, 2);
        $this->assertSame(200.0, $total["subtotal"]);
        $this->assertSame(10.0, $total["tax"]);
        $this->assertSame(210.0, $total["total"]);
    }

    public function testCalcCartTotalsWithCustomTaxRate(): void
    {
        $total = $this->cart->calc_cart_totals(100.0, 2, 0.1);
        $this->assertSame(200.0, $total["subtotal"]);
        $this->assertSame(20.0, $total["tax"]);
        $this->assertSame(220.0, $total["total"]);
    }
}