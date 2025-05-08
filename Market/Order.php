<?php
namespace Market\Order;

class Order
{
    /** @var OrderItem[] */
    private array $items = [];

    public function addItem(OrderItem $item): void { /*...*/ }
    public function deleteItem(OrderItem $item): void { /*...*/ }
    public function getItems(): array { return $this->items; }
    public function getItemsCount(): int { return count($this->items); }

    public function calculateTotalSum(): float
    {
        return array_reduce($this->items, fn($sum, $item) => $sum + $item->getTotalPrice(), 0.0);
    }

    public function printOrder(): string { /* Возврат PDF/HTML представления */ }
    public function showOrder(): array { /* Возврат массива данных */ }

    public function load(array $data): void { /* Заполнить из массива или БД */ }
    public function save(): void { /* Сохранить в БД или сессию */ }
    public function update(array $newData): void { /* Обновить поля */ }
    public function delete(): void { $this->items = []; }
}
