<?php

namespace App\Application\Actions;

use App\Domain\Collection\BoardingCardCollection;
use App\Domain\Model\BoardingCard\BoardingCard;

class BoardingCardStringifier
{
    /** @var BoardingCardCollection|BoardingCard[]  */
    private BoardingCardCollection $boardingCardCollection;

    /**
     * @param BoardingCardCollection $boardingCardCollection
     */
    public function __construct(BoardingCardCollection $boardingCardCollection)
    {
        $this->boardingCardCollection = $boardingCardCollection;
    }

    /**
     * Return sorted boarding card list
     *
     * @return array
     */
    public function execute(): array
    {
        $result = [];

        foreach ($this->boardingCardCollection as $boardingCard) {
            $result[] = $boardingCard->getSentence();
        }

        $result[] = 'Congratulation, you have arrived !';

        return $result;
    }


}