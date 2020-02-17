<?php
declare(strict_types=1);

class Blackjack
{
    const DEALER = 'dealer';
    const PLAYER = 'player';

    /** @var Participant */
    private $player;//could make this an array

    /** @var Participant */
    private $dealer;

    private $winner = '';

    public function __construct()
    {
        $this->dealer = new Dealer();
        $this->player = new Participant();
    }

    public function getPlayer(): Participant
    {
        return $this->player;
    }

    public function getDealer(): Participant
    {
        return $this->dealer;
    }

    public function setWinner(string $winner)
    {
        $this->winner = $winner;
    }

    public function getWinner(): string
    {
        return $this->winner;
    }

    public function doWeHaveAWinner(): bool
    {
        return $this->winner !== '';
    }

    public function checkWinner()
    {
        if($this->getPlayer()->isSurrender()) {
            $this->winner = self::DEALER;
            return;
        }

        if ($this->getDealer()->isBust() && !$this->getPlayer()->isBust()) {
            $this->winner = self::PLAYER;
            return;
        }

        if ($this->getPlayer()->isBust()) {
            $this->winner = self::DEALER;
            return;
        }

        switch($this->getPlayer()->getScore() <=> $this->getDealer()->getScore()) {
            case 1:
                $this->winner = self::PLAYER;
                return;
                break;
            case 0:
            case -1:
                $this->winner = self::DEALER;
                return;
                break;
        }

        throw new \Exception('No winner found');
    }

    public function dealerPlays()
    {
        while ($this->getDealer()->canContinue()) {
            $this->getDealer()->hit();
        }
    }
}