<pre>
<?php
$meteorites = ['5:0#27', '1:6#20', '1:7#46', '5:6#24', '3:4#47', '2:5#43', '4:7#26', '7:3#12', '1:3#26'];
$instructions = 'LBTTBRRRRRLBRBTLTTBTTBBBRTBLBTTBRLBRTB';
$starship = '3:2';
//== NE PAS TOUCHER

class Meteorites {

    public function __construct(private array $position) {

    }

    public function getMeteoritePositionArray():array {
        
        $meteoritesArray = [];

        foreach ($this->position as $key => $meteorite) {
            
            // Utilisez la fonction explode pour diviser la chaîne en fonction du caractère '#'
            $meteoriteData = explode('#', $meteorite);
            $coordonees =  explode(':', $meteoriteData[0]);

            $influenceArray = [
                $coordonees[0].':'.$coordonees[1]-1,
                $coordonees[0].':'.$coordonees[1],
                $coordonees[0].':'.$coordonees[1]+1,
                ($coordonees[0]-1).':'.$coordonees[1],
                ($coordonees[0]+1).':'.$coordonees[1]
            ];

            // Enregistrez les valeurs dans un tableau associatif
            $meteoritesArray[$key] = [
                'id' => uniqid(),
                'influence' => $influenceArray,
                'force' => ceil($meteoriteData[1] / 5)
            ];
        }
        return $meteoritesArray;
    }

}

class Sector {

    public function __construct(
        private Meteorites $meteorites,
        private int $maxXPosition, private int $maxYPosition, 
        private int $minXPosition, private int $minYPosition
    ){

    }

    public function getMaxXPosition(){
        return $this->maxXPosition;
    }

    public function getMaxYPosition(){
        return $this->maxYPosition;
    }

    public function getMinXPosition(){
        return $this->minXPosition;
    }

    public function getMinYPosition(){
        return $this->minYPosition;
    }

    public function getMeteorites(){
        return $this->meteorites;
    }

}

interface Actions{
    function move();
    function increaseEnergy(int $energy);
    function manageMeteorites(array $meteoriteInfosArray);
}

class StarShip implements Actions {

    public function __construct(private Sector $sector, private int $energySpent, private int $xPosition, private int $yPosition, private string $flightPlan, private int $totalMovements ) {
    }

    public function setXPosition_plus():void{
        
        if($this->xPosition < $this->sector->getMaxXPosition()){
            $this->xPosition = $this->xPosition + 1;
        }
    }

    public function setXPosition_minus():void{
        
        if($this->xPosition > $this->sector->getMinXPosition()){
            $this->xPosition = $this->xPosition - 1;
        }

    }

    public function setYPosition_plus():void{
        
        if($this->yPosition < $this->sector->getMaxYPosition()){
            $this->yPosition = $this->yPosition + 1;
        }

    }

    public function setYPosition_minus():void{
        
        if($this->yPosition > $this->sector->getMinYPosition()){
            $this->yPosition = $this->yPosition - 1;
        }  
    }

    public function addMovement():void{
        $this->increaseEnergy(1);
        $this->totalMovements = $this->totalMovements +1;
    }

    // Actions --------------------------------------------------------------------

    public function move(){

        $instructionArray = str_split($this->flightPlan);
        $meteoriteInfosArray = $this->sector->getMeteorites()->getMeteoritePositionArray();

        // init position 0
        $this->manageMeteorites($meteoriteInfosArray);

        for ( $i=0; $i < strlen($this->flightPlan); $i++ ) { 

            if($instructionArray[$i] == 'T'){
                $this->setYPosition_plus();
            }

            elseif($instructionArray[$i] == 'R'){
                $this->setXPosition_plus();
            }

            elseif($instructionArray[$i] == 'B'){
                $this->setYPosition_minus();
            }

            elseif($instructionArray[$i] == 'L'){
                $this->setXPosition_minus();
            }

            $this->addMovement();
            $this->manageMeteorites($meteoriteInfosArray);

        }

        echo($this->energySpent);

    }

    public function increaseEnergy(?int $energy) {
        $this->energySpent = $this->energySpent + $energy;
    }

    public function manageMeteorites($meteoriteInfosArray):void {
        
        foreach ($meteoriteInfosArray as $meteoriteInfos) {
            $influenceArray = $meteoriteInfos['influence'];
            if(in_array($this->xPosition.':'.$this->yPosition, $influenceArray)){
                $this->increaseEnergy($meteoriteInfos['force']);
            }
        }
    }

}

$defaultPosition = explode(':', $starship);

$meteoritesObj = new Meteorites($meteorites);
$sector = new Sector($meteoritesObj,7,7,0,0);
$starship = new StarShip($sector,0,$defaultPosition[0],$defaultPosition[1],$instructions,0);
$starship->move();

?>
</pre>


