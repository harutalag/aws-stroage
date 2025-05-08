<?php
namespace repositories;

use app\models\Ticket;

interface TicketRepositoryInterface
{
    public function load(int $ticketId): ?Ticket;
    public function save(Ticket $ticket): bool;
    public function update(Ticket $ticket): bool;
    public function delete(Ticket $ticket): bool;
}
