<?php
use repositories\TicketRepositoryInterface;
use repositories\ApiTicketRepository;


return new ApiTicketRepository(new \yii\httpclient\Client());