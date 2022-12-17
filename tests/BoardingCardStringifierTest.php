<?php

namespace Tests;

use App\Application\Actions\BoardingCardStringifier;
use App\Domain\Collection\BoardingCardCollection;
use PHPUnit\Framework\TestCase;

class BoardingCardStringifierTest extends TestCase
{
    public function testBoardingCardStringifier()
    {
        # Mocks
        $boardingCardList = json_decode(file_get_contents(__DIR__ . '/examples/boardingCardList.json'), true);
        $boardingCardCollection = new BoardingCardCollection();
        $boardingCardCollection->hydrate($boardingCardList);

        # Test
        $boardingCardStringifier = new BoardingCardStringifier($boardingCardCollection);
        $result = $boardingCardStringifier->execute();

        # Asserts
        $this->assertIsArray($result);
        $this->assertCount(6, $result);
        $this->assertStringContainsString('From Tokyo, take train , platform 6, to Osaka. Seat in 35. Small baggages only.', $result[0]);
        $this->assertStringContainsString('From London, take train , platform 3, to Paris. Seat in 27C.', $result[1]);
        $this->assertStringContainsString('From New York, take flight , gate A12, to London. Seat in 12A. Baggage will we automatically transferred from your last leg. Be an hour early for the flight.', $result[2]);
        $this->assertStringContainsString('From Lyon, take flight , gate B10, to Tokyo. Seat in 13A. No Baggage.', $result[3]);
        $this->assertStringContainsString('From Paris, take bus to Lyon. Seat in 5B.', $result[4]);
        $this->assertStringContainsString('Congratulation, you have arrived', $result[5]);
    }
}