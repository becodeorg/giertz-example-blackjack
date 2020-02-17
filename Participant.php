<?php
declare(strict_types=1);

class Participant
{
    private const MAX_ALLOWED_SCORE = 21;

    private $score = 0;

    /**
     * @var bool
     */
    private $isBust = false;

    /**
     * @var bool
     */
    private $surrender = false;

    public function hit()
    {
        $this->score += random_int(1, 11);
    }

    public function stand()
    {
        
    }

    public function getScore() : int
    {
        return $this->score;
    }

    public function canContinue() : bool
    {
        if($this->getScore() > self::MAX_ALLOWED_SCORE) {
            $this->isBust = true;
        }
        return !$this->isBust;
    }

    public function isBust() : bool
    {
        return $this->isBust;
    }

    public function surrender() : void
    {
        $this->surrender = true;
    }

    public function isSurrender(): bool
    {
        return $this->surrender;
    }
}