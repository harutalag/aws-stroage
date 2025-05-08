<?php
use PHPUnit\Framework\TestCase;
use Market\Order\OrderItem;

class OrderItemTest extends TestCase
{
    public function testTotalPriceCalculation(): void
    {
        $item = new OrderItem('Test Product', 100.0, 3);
        $this->assertEquals(300.0, $item->getTotalPrice());
    }
}
