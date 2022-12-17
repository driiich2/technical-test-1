<?php

namespace Tests;

use App\Application\Actions\BoardingCardSorter;
use App\Domain\Collection\BoardingCardCollection;
use PHPUnit\Framework\TestCase;

class BoardingCardSorterTest extends TestCase
{
    public function testBoardingCardSorter()
    {
        # Mocks
        $boardingCardList = json_decode(file_get_contents(__DIR__ . '/examples/boardingCardList.json'), true);
        $boardingCardCollection = new BoardingCardCollection();
        $boardingCardCollection->hydrate($boardingCardList);

        # Test
        $boardingCardSorter = new BoardingCardSorter($boardingCardCollection);
        $result = $boardingCardSorter->execute();

        # Asserts
        $this->assertIsArray($result);
        $this->assertCount(5, $result);
        $this->assertSame('New York', $result[0]->getFrom());
        $this->assertSame('London', $result[1]->getFrom());
        $this->assertSame('Paris', $result[2]->getFrom());
        $this->assertSame('Lyon', $result[3]->getFrom());
        $this->assertSame('Tokyo', $result[4]->getFrom());
    }
}