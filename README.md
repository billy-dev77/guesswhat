# Guess What

Prise en main de la POO avec PHP

Niveau : Deuxième année de BTS SIO SLAM

Prérequis : bases de la programmation, PHP 7 ou supérieur installé sur votre machine de dev.

## Thème 

Développer une logique de jeu en PHP en mettant en oeuvre de la conception objet et des tests unitaires.


Les étapes d'un scénario typique d'usage sont 

1. (optionnel pour le joueur) paramétrage du jeu (par exemple choix du jeu de cartes, activation de l'aide à la recherche, ...)
2. Lancement d'une partie (le jeu instancie un jeu de carte et tire une carte "au hasard"), que le joueur doit deviner en un *temps optimal*
3. Le joueur propose une carte
4. Si ce n'est pas la bonne carte, alors si l'aide est activée, le joeur est informé si la carte qu'il a soumise est plus petite ou plus grande que celle à deviner. Retour en 3.
5. (c'est la bonne carte alors) La partie se termine et le jeu affiche des éléments d'analyse (nombre de fois où le joueur a soumis une carte, sa *qualité stratégique*, ...)
6. Fin de la partie.

## Objectif

* Conception et mise au point de la logique applicative avec PHPUnit
* Structure de données, recherche d'un élément dans une liste
* Analyse des actions du joueur (fonction du nombre de cartes, aides à la décision)
## Challenge 1 de prise en main 

La vérification des prérequis de mon système a été faite avec succès.
Le téléchargement du projet a été faite en ligne de commande grâce à `git clone` ainsi que l'installation des prérequis.

J'ai tester le bon fonctionnement du système et lancement des tests unitaires.
  
À **la racine du projet** du projet.

**Exemple :**

```
C:\xampp\htdocs\guesswhat>php ./bin/phpunit

Testing Project Test Suite
....FFFF.                                                    8 / 8 (100%)

Time: 48 ms, Memory: 6.00 MB

There were 4 failures:

1) App\Tests\Core\CardTest::testCompareSameNameNoSameColor
not implemented !

guesswhat/tests/Core/CardTest.php:65

2) App\Tests\Core\CardTest::testCompareNoSameCardNoSameColor
not implemented !

guesswhat/tests/Core/CardTest.php:71

3) App\Tests\Core\CardTest::testCompareNoSameCardSameColor
not implemented !

guesswhat/tests/Core/CardTest.php:77

4) App\Tests\Core\CardTest::testToString
not implemented !

guesswhat/tests/Core/CardTest.php:84

FAILURES!
Tests: 8, Assertions: 10, Failures: 4.
```
## Challenge 2 implémentation des TODOs de `CardTest`

Après implémentation des TODOs

Voici le code de la classe de ``CardTest`` :

```php
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

}
```
** La méthode toString :
```php
  public function testToString()
  {
    /**
    * vérification de la représentation textuelle d'une carte  
    */
      $card = new Card('As', 'Trefle');
      $this->assertEquals('As Trefle', $card->__toString());
  }
```

## Challenge 3 conception de tests unitaires pour `CardGame32`

Ce challenge c'est celui que j'ai eu plus du mal à faire, parce que j'avais du mal à comprendre ce qui fallait faire.
Mais au finale ça été fait. La création de ma nouvelle classe test.

**Voici :**
```php
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
```
**Le test ``phpunit`` :**

````
C:\xampp\htdocs\guesswhat>php .\bin\phpunit tests\Core\CardGame32Test.php
PHPUnit 7.5.20 by Sebastian Bergmann and contributors.

Testing App\Tests\Core\CardGame32Test
.....                                                               5 / 5 (100%)

Time: 607 ms, Memory: 6.00 MB

OK (5 tests, 5 assertions)


````
## Challenge 4 conception de tests unitaires pour `Guess`
Pas terminé, je n'ai pas pu le commencer. Je suis encore trop lent et j'ai encore quelque lacune. 

## Livraison


* Dépôt de mon projet sur Github avec un *README.md*. 

Ressources utiles:

* L'usage de la syntaxe de documentation PHPDoc
[DocBloc](https://docs.phpdoc.org/3.0/guide/getting-started/what-is-a-docblock.html)
* Lien du projet ``Guesswhat``
* Lien de mon projet ``Guesswhat``

Bonne correction !
g u e s s w h t a 
 
 