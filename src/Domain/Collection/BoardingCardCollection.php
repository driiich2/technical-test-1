<?php

namespace App\Domain\Collection;

use App\Domain\Model\BoardingCard\BoardingCard;
use App\Domain\Model\BoardingCard\BoardingCardBus;
use App\Domain\Model\BoardingCard\BoardingCardFlight;
use App\Domain\Model\BoardingCard\BoardingCardTrain;
use Exception;
use Iterator;

class BoardingCardCollection implements Iterator
{
    /** @var array|BoardingCard[] */
    private array $boardingCardList;
    protected int $position;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->position = 0;
        $this->boardingCardList = [];
    }

    /**
     * @param array $boardingCardList
     * @return BoardingCardCollection
     * @throws Exception
     */
    public function hydrate(array $boardingCardList): self
    {
        foreach ($boardingCardList as $boardingCard) {
            if (!isset($boardingCard[BoardingCard::TYPE])) {
                throw new Exception('Type is missing');
            }
            switch ($boardingCard[BoardingCard::TYPE]) {
                case BoardingCardBus::TYPE:
                    $this->boardingCardList[] = new BoardingCardBus($boardingCard);
                    break;
                case BoardingCardTrain::TYPE:
                    $this->boardingCardList[] = new BoardingCardTrain($boardingCard);
                    break;
                case BoardingCardFlight::TYPE:
                    $this->boardingCardList[] = new BoardingCardFlight($boardingCard);
                    break;
                default:
                    throw new Exception("Type {$boardingCard[BoardingCard::TYPE]} does not exist");
            }
        }
        return $this;
    }

    /**
     * @param array $boardingCardList
     * @return BoardingCardCollection
     */
    public function fromArray(array $boardingCardList): self
    {
        $this->boardingCardList = $boardingCardList;
        return $this;
    }

    public function current()
    {
        return $this->boardingCardList[$this->position];
    }

    public function next()
    {
        ++$this->position;
        return $this->valid();
    }

    public function key()
    {
        return $this->position;
    }

    public function valid()
    {
        return isset($this->boardingCardList[$this->position]);
    }

    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * @return array|BoardingCard[]
     */
    public function toArray(): array
    {
        $array = [];
        foreach ($this->boardingCardList as $boardingCard) {
            $array[$boardingCard->getTripNumber()] = $boardingCard;
        }
        return $array;
    }
}