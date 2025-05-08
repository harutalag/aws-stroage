<?php
use PHPUnit\Framework\TestCase;
use Market\Order\Order;
use Market\Order\OrderItem;

class OrderTest extends TestCase
{
    public function testAddAndCountItems(): void
    {
        $order = new Order();
        $item1 = new OrderItem('Item 1', 10.0, 1);
        $item2 = new OrderItem('Item 2', 20.0, 2);

        $order->addItem($item1);
        $order->addItem($item2);

        $this->assertCount(2, $order->getItems());
        $this->assertEquals(2, $order->getItemsCount());
    }

    public function testCalculateTotalSum(): void
    {
        $order = new Order();
        $order->addItem(new OrderItem('Item A', 50.0, 2)); // 100
        $order->addItem(new OrderItem('Item B', 30.0, 1)); // 30

        $this->assertEquals(130.0, $order->calculateTotalSum());
    }

    public function testDeleteItems(): void
    {
        $order = new Order();
        $order->addItem(new OrderItem('Item A', 50.0, 2));

        $order->delete();

        $this->assertEquals(0, $order->getItemsCount());
        $this->assertEmpty($order->getItems());
    }

    public function testLoadOrder(): void
    {
        $order = new Order();

        $orderData = [
            ['name' => 'Loaded Item', 'price' => 20.0, 'quantity' => 3],
            ['name' => 'Another Item', 'price' => 15.5, 'quantity' => 1]
        ];

        $items = array_map(fn($d) => new OrderItem($d['name'], $d['price'], $d['quantity']), $orderData);

        foreach ($items as $item) {
            $order->addItem($item);
        }

        $this->assertCount(2, $order->getItems());
        $this->assertEquals(75.5, $order->calculateTotalSum());
    }
}
