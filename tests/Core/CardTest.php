<?php

namespace App\Tests\Core;

use App\Core\CardGame32;
use PHPUnit\Framework\TestCase;
use App\Core\Card;

class CardTest extends TestCase
{

  public function testName()
  {
    $card = new Card('As', 'Trefle');
    $this->assertEquals('As', $card->getName());
    $card = new Card('2', 'Trefle');
    $this->assertEquals('2', $card->getName());

  }

  public function testColor()
  {
    $card = new Card('As', 'Trefle');
    $this->assertEquals('Trefle', $card->getColor());
    $card = new Card('As', 'Pique');
    $this->assertEquals('Pique', $card->getColor());
  }

  public function testCompareSameCard()
  {
    $card1 = new Card('As', 'Trefle');
    $card2 = new Card('As', 'Trefle');
    $this->assertEquals(0, CardGame32::compare($card1,$card2));
  }

  public function testCompareSameNameNoSameColor()
  {
    // même nom pas même couleur
      $card1 = new Card('As', 'Trefle');
      $card2 = new Card('As', 'pique');
      $this->assertEquals(1, CardGame32::compare($card1,$card2));
  }

  public function testCompareNoSameCardNoSameColor()
  {
    // pas même nom pas même couleur
      $card1 = new Card('As', 'Trefle');
      $card2 = new Card('dame', 'pique');
      $this->assertEquals(1, CardGame32::compare($card1,$card2));
  }

  public function testCompareNoSameCardSameColor()
  {
    // pas même nom même couleurs
      $card1 = new Card('dame', 'pique');
      $card2 = new Card('roi', 'pique');
      $this->assertEquals(-1, CardGame32::compare($card1,$card2));
  }


  public function testToString()
  {
    //vérification de la représentation textuelle d'une carte
      $card = new Card('As', 'Trefle');
      $this->assertEquals('As Trefle', $card->__toString());
  }

}
