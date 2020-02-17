<?php
declare(strict_types=1);

class Dealer extends Participant
{
    private const MIN_SCORE_DEALER = 15;

    public function canContinue() : bool
    {
        return $this->getScore() < self::MIN_SCORE_DEALER && parent::canContinue();
    }
}