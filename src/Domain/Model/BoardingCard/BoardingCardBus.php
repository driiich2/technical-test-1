<?php

namespace App\Domain\Model\BoardingCard;

class BoardingCardBus extends BoardingCard
{

    public const TYPE = 'bus';

    /**
     * @return string
     */
    public function getType(): string
    {
        return self::TYPE;
    }
}