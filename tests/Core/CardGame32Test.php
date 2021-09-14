<?php

namespace App\Tests\Core;

use App\Core\Card;
use App\Core\CardGame32;
use PHPUnit\Framework\TestCase;

class CardGame32Test extends TestCase
{

    public function testToString2Cards()
    {
        $jeudeCarte = new CardGame32([new Card('AS', 'Trefle'), new Card('Roi', 'Pique')]);
        $this->assertEquals('CardGame32 : 2 Carte(s)', $jeudeCarte->__toString());

    }

    public function testToString1Cards()
    {
        $jeudeCarte = new CardGame32([new Card('AS', 'Pique')]);
        $this->assertEquals('CardGame32 : 1 Carte(s)', $jeudeCarte->__toString());
    }

    public function testToString32Card()
    {
        $cards = CardGame32::factoryCardGame32();
        $this->assertEquals('CardGame32 : 32 Carte(s)', $cards->__toString());
    }

    public function testGetCard()
    {
        $card = new CardGame32([new Card('Dame', 'Coeur')]);
        $this->assertEquals(new  Card('Dame', 'Coeur'), $card->getCard('0'));
    }

    public function testshuffle()
    {
        $cardGameMelange = CardGame32::factoryCardGame32();
        $cardGameMelange->shuffle();
        $cardGame = CardGame32::factoryCardGame32();
        $this->assertNotEquals($cardGameMelange, $cardGame);
    }

}
