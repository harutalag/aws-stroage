<?php
namespace repositories;

use app\models\Ticket;

class DbTicketRepository implements TicketRepositoryInterface
{
    public function load(int $ticketId): ?Ticket
    {
        return Ticket::findOne($ticketId);
    }

    public function save(Ticket $ticket): bool
    {
        return $ticket->save();
    }

    public function update(Ticket $ticket): bool
    {
        return $ticket->update() !== false;
    }

    public function delete(Ticket $ticket): bool
    {
        return $ticket->delete() !== false;
    }
}
