<?php

namespace App\Domain\Model\BoardingCard;

class BoardingCardFlight extends BoardingCard
{
    public const TYPE = 'flight';
    public const KEY_GATE = 'gate';

    private ?string $gate;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->gate = $data[self::KEY_GATE] ?? '';
    }

    /**
     * @param string|null $gate
     * @return BoardingCardFlight
     */
    public function setGate(?string $gate): BoardingCardFlight
    {
        $this->gate = $gate;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGate(): ?string
    {
        return $this->gate;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return self::TYPE;
    }

    public function getSentence(): string
    {
        $sentence = "From {$this->getFrom()}, ";
        $sentence .= "take {$this->getType()} ";
        $sentence .= $this->getGate() ? ", gate {$this->getGate()}, " : '';
        $sentence .= "to {$this->getTo()}. ";
        $sentence .= $this->getSeatNumber() ? "Seat in {$this->getSeatNumber()}. " : '';
        foreach ($this->getAdditionalInfos() as $additionalInfo) {
            $sentence .= "$additionalInfo. ";
        }
        return $sentence;
    }

}