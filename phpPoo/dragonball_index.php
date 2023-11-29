<pre>
<?php

class SuperGuerrier{

    public function __construct(
        private string $name, 
        private int $sante, 
        private int $force, 
        private int $special, 
        private int $reserveSuperGuerrier,
        private bool $isKo
        )
    {
    }

    public function getName(){
        return $this->name;
    }

    public function getSante(){ 
        return $this->sante;
    }

    public function setSante(int $sante){
        $this->sante = $sante;
    }

    public function getForce(){
        return $this->force;
    }

    public function getSpecial(){
        return $this->special;
    }

    public function getReserveSuperGuerrier(){
        return $this->reserveSuperGuerrier;
    }

    public function setReserveSuperGuerrier(int $reserveSuperGuerrier){
        $this->reserveSuperGuerrier = $reserveSuperGuerrier;
    }

    public function isKo(){
        if($this->sante <= 0){
            return true;
        }
        return false;
    }

    public function isSpecialReady(){
        if($this->reserveSuperGuerrier >= 1000){
            return true;
        }
        return false;
    }

}

$sangoku = new SuperGuerrier('SANGOKU', 10000, 208, 655, 0, false);
$vegeta = new SuperGuerrier('VEGETA', 10000, 230, 620, 0, false);

// $sangoku = 'HP:10000 F:208 S:655';
// $vegeta = 'HP:10000 F:230 S:620';

// $sangoku = new SuperGuerrier('SANGOKU', 2000, 200, 454, 0, false);
// $vegeta = new SuperGuerrier('VEGETA', 2000, 200, 581, 0, false);

class Duel
{
    public function __construct(
        private SuperGuerrier $joueur1, 
        private SuperGuerrier $joueur2,
        private int $turn,
        private int $specialJoueur1Countered,
        private int $specialJoueur2Countered
    )
    {
    }

    private function isNexTurn():?string
    {
        if ($this->joueur1->getSante() > 0 && $this->joueur2->getSante() > 0){
            return 'continue';
        }
        elseif ($this->joueur1->getSante() <= 0 && $this->joueur2->getSante() <= 0){
            return 'draw';
        }
        return false;
    }

    public function fight()
    {

        if($this->isNexTurn() == 'continue'){
            
            if($this->joueur1->getReserveSuperGuerrier() >= 1000 || $this->joueur2->getReserveSuperGuerrier() >= 1000 ){
                
                if($this->joueur1->getReserveSuperGuerrier() >= 1000 && $this->joueur2->getReserveSuperGuerrier() < 1000){
                    
                    $this->joueur2->setSante($this->joueur2->getSante() - $this->joueur1->getSpecial());
                    $this->specialJoueur1Countered = $this->specialJoueur1Countered + 1;
                    $this->joueur1->setReserveSuperGuerrier(0);

                    // END OF TURN
                    $this->turn = $this->turn + 1;
                    return $this->fight();

                }
                elseif($this->joueur2->getReserveSuperGuerrier() >= 1000 && $this->joueur2->getReserveSuperGuerrier() < 1000){
                    
                    $this->joueur1->setSante($this->joueur1->getSante() - $this->joueur2->getSpecial());
                    $this->specialJoueur2Countered = $this->specialJoueur2Countered + 1;
                    $this->joueur2->setReserveSuperGuerrier(0);

                    // END OF TURN
                    $this->turn = $this->turn + 1;
                    return $this->fight();
                }
                elseif($this->joueur2->getReserveSuperGuerrier() >= 1000 && $this->joueur2->getReserveSuperGuerrier() >= 1000){

                    $this->joueur1->setSante($this->joueur1->getSante() - $this->joueur2->getSpecial());
                    $this->specialJoueur2Countered = $this->specialJoueur2Countered + 1;
                    $this->joueur2->setReserveSuperGuerrier(0);

                    // END OF TURN
                    $this->turn = $this->turn + 1;
                    return $this->fight();

                }

            }

            $this->nextTurnHit();

        }
        elseif ($this->isNexTurn() == 'draw'){
            
            // print_r($this->turn.PHP_EOL);
            // print_r('santé '.$this->joueur1->getName().' : '.$this->joueur1->getSante().PHP_EOL);
            // print_r('reserve '.$this->joueur1->getName().' : '.$this->joueur1->getReserveSuperGuerrier().PHP_EOL);
            // print_r('coup_speciaux '.$this->joueur1->getName().' : '.$this->specialJoueur1Countered.PHP_EOL);
            // print_r('santé '.$this->joueur2->getName().' : '.$this->joueur2->getSante().PHP_EOL);
            // print_r('reserve '.$this->joueur2->getName().' : '.$this->joueur2->getReserveSuperGuerrier().PHP_EOL);
            // print_r('coup_speciaux '.$this->joueur2->getName().' : '.$this->specialJoueur2Countered.PHP_EOL);

            print_r(' DRAW_ '.$this->turn);

        }
        else{
            
            if($this->joueur1->getSante() > 0){
                $winnerName = $this->joueur1->getName();
                $specials = $this->specialJoueur1Countered;
            }else{
                $winnerName = $this->joueur2->getName();
                $specials = $this->specialJoueur2Countered;
            }

            echo($winnerName.'_'.$this->turn.'_'.$specials);

            // print_r($this->turn.PHP_EOL);
            // print_r('santé '.$this->joueur1->getName().' : '.$this->joueur1->getSante().PHP_EOL);
            // print_r('reserve '.$this->joueur1->getName().' : '.$this->joueur1->getReserveSuperGuerrier().PHP_EOL);
            // print_r('coup_speciaux '.$this->joueur1->getName().' : '.$this->specialJoueur1Countered.PHP_EOL);
            // print_r('santé '.$this->joueur2->getName().' : '.$this->joueur2->getSante().PHP_EOL);
            // print_r('reserve '.$this->joueur2->getName().' : '.$this->joueur2->getReserveSuperGuerrier().PHP_EOL);
            // print_r('coup_speciaux '.$this->joueur2->getName().' : '.$this->specialJoueur2Countered.PHP_EOL);

        }

    }

    private function nextTurnHit()
    {
        // HIT TURN 
        $this->joueur1->setSante($this->joueur1->getSante() - $this->joueur2->getForce());
        $this->joueur2->setSante($this->joueur2->getSante() - $this->joueur1->getForce());

        // RESERVE SUPER GUERRIER
        $this->joueur1->setReserveSuperGuerrier($this->joueur1->getReserveSuperGuerrier() + $this->joueur2->getForce());
        $this->joueur2->setReserveSuperGuerrier($this->joueur2->getReserveSuperGuerrier() + $this->joueur1->getForce());
        
        // END OF TURN
        $this->turn = $this->turn + 1;
        return $this->fight();

    }

}

$duel = new Duel($sangoku, $vegeta,0,0,0);
$duel->fight();

?>
</pre>