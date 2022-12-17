<?php

namespace App\Domain\Model\BoardingCard;

abstract class BoardingCard
{
    public const TYPE = 'type';

    public const KEY_TRIP_NUMBER = 'trip_number';
    public const KEY_NAME = 'name';
    public const KEY_FROM = 'from';
    public const KEY_TO = 'to';
    public const KEY_DEPARTURE_TIME = 'departure_time';
    public const KEY_ARRIVAL_TIME = 'arrival_time';
    public const KEY_SEAT_NUMBER = 'seat_number';
    public const KEY_ADDITIONAL_INFOS = 'additional_infos';

    protected string $tripNumber;
    protected string $from;
    protected string $to;
    protected ?string $name;
    protected ?string $seatNumber;
    protected ?int $departureTime;
    protected ?int $arrivalTime;
    protected array $additionalInfos = [];

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->tripNumber = $data[self::KEY_TRIP_NUMBER];
        $this->from = $data[self::KEY_FROM];
        $this->to = $data[self::KEY_TO];
        $this->name = $data[self::KEY_NAME] ?? null;
        $this->seatNumber = $data[self::KEY_SEAT_NUMBER] ?? null;
        $this->departureTime = $data[self::KEY_DEPARTURE_TIME] ?? null;
        $this->arrivalTime = $data[self::KEY_ARRIVAL_TIME] ?? null;
        $this->additionalInfos = $data[self::KEY_ADDITIONAL_INFOS] ?? [];
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return BoardingCard
     */
    public function setName(?string $name): BoardingCard
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getDepartureTime(): ?int
    {
        return $this->departureTime;
    }

    /**
     * @param int|null $departureTime
     * @return BoardingCard
     */
    public function setDepartureTime(?int $departureTime): BoardingCard
    {
        $this->departureTime = $departureTime;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getArrivalTime(): ?int
    {
        return $this->arrivalTime;
    }

    /**
     * @param int|null $arrivalTime
     * @return BoardingCard
     */
    public function setArrivalTime(?int $arrivalTime): BoardingCard
    {
        $this->arrivalTime = $arrivalTime;
        return $this;
    }

    /**
     * @return string
     */
    public function getTripNumber(): string
    {
        return $this->tripNumber;
    }

    /**
     * @param string $tripNumber
     * @return BoardingCard
     */
    public function setTripNumber(string $tripNumber): BoardingCard
    {
        $this->tripNumber = $tripNumber;
        return $this;
    }

    public function getSentence(): string
    {
        $sentence = "From {$this->getFrom()}, ";
        $sentence .= "take {$this->getType()} ";
        $sentence .= "to {$this->getTo()}. ";
        $sentence .= $this->getSeatNumber() ? "Seat in {$this->getSeatNumber()}. " : '';
        foreach ($this->getAdditionalInfos() as $additionalInfo) {
            $sentence .= "$additionalInfo. ";
        }
        return $sentence;
    }

    /**
     * @return string
     */
    public function getFrom(): string
    {
        return $this->from;
    }

    /**
     * @param string $from
     * @return BoardingCard
     */
    public function setFrom(string $from): BoardingCard
    {
        $this->from = $from;
        return $this;
    }

    public abstract function getType(): string;

    /**
     * @return string
     */
    public function getTo(): string
    {
        return $this->to;
    }

    /**
     * @param string $to
     * @return BoardingCard
     */
    public function setTo(string $to): BoardingCard
    {
        $this->to = $to;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSeatNumber(): ?string
    {
        return $this->seatNumber;
    }

    /**
     * @param string|null $seatNumber
     * @return BoardingCard
     */
    public function setSeatNumber(?string $seatNumber): BoardingCard
    {
        $this->seatNumber = $seatNumber;
        return $this;
    }

    /**
     * @return array
     */
    public function getAdditionalInfos(): array
    {
        return $this->additionalInfos;
    }

    /**
     * @param array $additionalInfos
     * @return BoardingCard
     */
    public function setAdditionalInfos(array $additionalInfos): BoardingCard
    {
        $this->additionalInfos = $additionalInfos;
        return $this;
    }
}