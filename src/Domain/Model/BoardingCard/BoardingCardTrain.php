<?php

namespace App\Domain\Model\BoardingCard;

class BoardingCardTrain extends BoardingCard
{
    public const TYPE = 'train';

    public const KEY_PLATFORM = 'platform';

    private ?string $platform;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->platform = $data[self::KEY_PLATFORM] ?? null;
    }

    /**
     * @return string|null
     */
    public function getPlatform(): ?string
    {
        return $this->platform;
    }

    /**
     * @param string|null $platform
     * @return BoardingCardTrain
     */
    public function setPlatform(?string $platform): BoardingCardTrain
    {
        $this->platform = $platform;
        return $this;
    }

    public function getSentence(): string
    {
        $sentence = "From {$this->getFrom()}, ";
        $sentence .= "take {$this->getType()} ";
        $sentence .= $this->getPlatform() ? ", platform {$this->getPlatform()}, " : '';
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
    public function getType(): string
    {
        return self::TYPE;
    }
}