<?php
namespace Market\Order;

class OrderItem
{
    
public string $name;
public float $price;
public int $quantity;

    public function __construct(
        string $name,
        float $price,
        int $quantity
    ) {
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
}

public function getTotalPrice(): float
{
    return $this->price * $this->quantity;
}

// Геттеры, сеттеры и валидация
}
