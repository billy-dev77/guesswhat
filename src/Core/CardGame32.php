<?php

namespace App\Core;

/**
 * Class CardGame32 : un jeu de cartes.
 * @package App\Core
 */
class CardGame32
{
    /**
   * @var $cards array a array of Cards
   */
  private $cards;

  /**
   * Guess constructor.
   * @param array $cards
   */
  public function __construct(array $cards)
  {
    $this->cards = $cards;
  }

  /**
   * Brasse le jeu de cartes
   */
  public function shuffle()
  {
    // TODO (voir les fonctions sur les tableaux)
      return shuffle($this->cards);
  }
  // ajouter une méthode reOrder qui remet le paquet en ordre
    const ORDERS_CARDS = ['as' =>8, 'roi' =>7, 'dame' =>6, 'valet' =>5, '10' =>4, '9' => 3, '8' =>2, '7' =>1 ];
    const ORDERS_COLORS = ['trefle' =>4, 'coeur' =>3, 'pique' =>2, 'carreau' =>1];

  /** définir une relation d'ordre entre instance de Card.
   * à valeur égale (name) c'est l'ordre de la couleur qui prime
   * coeur > carreau > pique > trèfle
   * Attention : si AS de Coeur est plus fort que AS de Trèfle,
   * 2 de Coeur sera cependant plus faible que 3 de Trèfle
   *
   *  Remarque : cette méthode n'est pas de portée d'instance (static)
   *
   * @see https://www.php.net/manual/fr/function.usort.php
   *
   * @param $c1 Card
   * @param $c2 Card
   * @return int
   * <ul>
   *  <li> zéro si $c1 et $c2 sont considérés comme égaux </li>
   *  <li> -1 si $c1 est considéré inférieur à $c2</li>
   * <li> +1 si $c1 est considéré supérieur à $c2</li>
   * </ul>
   *
   */
  public static function compare(Card $c1, Card $c2) : int
  {
    // prendre en compte la couleur !

    $c1Name = strtolower($c1->getName());
    $c2Name = strtolower($c2->getName());
    $c1Colors = strtolower($c1->getColor());
    $c2Colors = strtolower($c2->getColor());


      if ($c1Name === $c2Name) {
          if ($c1Colors === $c2Colors){
              return 0;
          }
        return (self::ORDERS_COLORS[$c1Colors] > self::ORDERS_COLORS[$c2Colors]) ? +1 : -1;
    }
    return (self::ORDERS_CARDS[$c1Name] > self::ORDERS_CARDS[$c2Name]) ? +1 : -1;
  }

 // TODO manque PHPDoc
  public static function factoryCardGame32() : CardGame32 {
     // création d'un jeu de 32 cartes
    $cardGame = new CardGame32([new Card('As', 'Trefle'), new Card('roi', 'Trefle' ),
        new Card('dame', 'Trefle' ),new Card('valet', 'Trefle'), new Card('10', 'Trefle' ),
        new Card('9', 'Trefle' ), new Card('8', 'Trefle' ), new Card('7', 'Trefle' ),
        new Card('As', 'Coeur'), new Card('roi', 'Coeur' ),
        new Card('dame', 'Coeur' ),new Card('valet', 'Coeur'), new Card('10', 'Coeur' ),
        new Card('9', 'Coeur' ), new Card('8', 'Coeur' ), new Card('7', 'Coeur' ),
        new Card('As', 'Pique'), new Card('roi', 'Pique' ),
        new Card('dame', 'Pique' ),new Card('valet', 'Pique'), new Card('10', 'Pique' ),
        new Card('9', 'Pique' ), new Card('8', 'Pique' ), new Card('7', 'Pique' ),
        new Card('As', 'Carreau'), new Card('roi', 'Carreau' ),
        new Card('dame', 'Carreau' ),new Card('valet', 'Carreau'), new Card('10', 'Carreau' ),
        new Card('9', 'Carreau' ), new Card('8', 'Carreau' ), new Card('7', 'Carreau' )]);

    return $cardGame;
  }

  // TODO manque PHPDoc
  public function getCard($index) : Card {
    //Prend les Compris entre 0 et 32
      if ($index <= 32 & $index >=0)
    return  $this->cards[$index];
  }
public function __toString()
{
    return 'CardGame32 : '.count($this ->cards).' Carte(s)';
}

}

