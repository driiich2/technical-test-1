<?php

namespace App\Application\Actions;

use App\Domain\Collection\BoardingCardCollection;
use App\Domain\Model\BoardingCard\BoardingCard;

class BoardingCardSorter
{
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
     * @return array|BoardingCard[]
     */
    public function execute(): array
    {
        $boardingCardList = $this->boardingCardCollection->toArray();

        # Create an array which contains trip numbers
        $tripNumberList = $this->createTripNumberList();

        # For each boarding card
        $sortedTripNumberList = $this->sortTripNumberList($boardingCardList, $tripNumberList);

        # Return the sorted collection
        return array_map(function ($sortedTripNumber) use ($boardingCardList) {
            return $boardingCardList[$sortedTripNumber];
        }, $sortedTripNumberList);
    }

    /**
     * @param array $boardingCardList
     * @param array $sortedTripNumberList
     * @return array
     */
    protected function sortTripNumberList(array $boardingCardList, array $sortedTripNumberList): array {
        # Create a list with From values only
        $fromList = array_map(function ($bc) {
            return $bc->getFrom();
        }, $boardingCardList);

        foreach ($this->boardingCardCollection as $boardingCard) {
            # Find the "From" board using current "To" value
            $keyFrom = array_search($boardingCard->getTo(), $fromList);

            # Move the trip number
            $tripNumber = $boardingCard->getTripNumber();
            # First, delete the element
            array_splice($sortedTripNumberList, array_search($tripNumber, $sortedTripNumberList), 1);
            if ($keyFrom === false) {
                # If the "From" board is not found, just push the trip number to the end
                $sortedTripNumberList[] = $tripNumber;
            } else {
                # If the "From" board has been found, insert it just before the found item
                $tripNumberFrom = $boardingCardList[$keyFrom]->getTripNumber();
                $index = array_search($tripNumberFrom, $sortedTripNumberList);
                array_splice($sortedTripNumberList, $index, 0, $tripNumber);
            }
        }
        return $sortedTripNumberList;
    }

    /**
     * @return array
     */
    protected function createTripNumberList(): array
    {
        $sortedTripNumberList = [];
        foreach ($this->boardingCardCollection as $boardingCard) {
            $sortedTripNumberList[] = $boardingCard->getTripNumber();
        }
        return $sortedTripNumberList;
    }
}